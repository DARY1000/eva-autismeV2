<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.feexpay' => [
            'shop_id' => 'shop_test', 'api_key' => 'test_key_x', 'mode' => 'sandbox', 'webhook_secret' => 'secret',
        ]]);

        $this->product = Product::create([
            'name' => 'Minuteur', 'slug' => 'minuteur-test', 'category' => 'autonomie', 'summary' => 'Un minuteur.',
            'price' => 2500, 'stock' => 3, 'is_published' => true,
        ]);
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'prenom' => 'Amina', 'nom' => 'Dossou', 'email' => 'amina@example.org', 'telephone' => '01 97 00 00 00',
            'pays' => 'BJ', 'ville' => 'Cotonou', 'delivery_mode' => 'retrait', 'payment_method' => 'mtn',
            '_form_ts' => Crypt::encryptString((string) (time() - 30)),
        ], $overrides);
    }

    private function fakeFeexPay(): void
    {
        Http::fake(['sandbox-api.feexpay.me/*' => Http::response(['reference' => 'ref-1', 'status' => 'PENDING', 'amount' => 5000])]);
    }

    private function order(): Order
    {
        $this->post(route('boutique.panier.add', $this->product), ['quantity' => 2]);
        $this->post(route('boutique.commande.store'), $this->payload());

        return Order::sole();
    }

    public function test_only_published_products_with_a_price_are_shown(): void
    {
        Product::create(['name' => 'Sans prix', 'slug' => 'sans-prix', 'category' => 'guides', 'summary' => 'x', 'is_published' => true]);
        Product::create(['name' => 'Brouillon', 'slug' => 'brouillon', 'category' => 'guides', 'summary' => 'x', 'price' => 500]);

        $this->get(route('boutique.index'))->assertOk()->assertSee('Minuteur')->assertDontSee('Sans prix')->assertDontSee('Brouillon');
        $this->get(route('boutique.show', 'brouillon'))->assertNotFound();
    }

    public function test_an_order_reserves_stock_and_starts_the_payment_with_the_database_price(): void
    {
        $this->fakeFeexPay();

        $order = $this->order();

        $this->assertSame(5000, $order->total);
        $this->assertSame('ref-1', $order->payment_reference);
        $this->assertSame(1, $this->product->fresh()->stock);
        $this->assertSame(2, $order->items->sole()->quantity);
        Http::assertSent(fn ($request) => $request['amount'] === 5000 && $request['callback_info'] === 'cmd:'.$order->reference);
        $this->assertSame(0, app(\App\Support\Cart::class)->count());
    }

    public function test_a_price_sent_by_the_visitor_is_ignored(): void
    {
        $this->fakeFeexPay();
        $this->post(route('boutique.panier.add', $this->product), ['quantity' => 1, 'price' => 1]);
        $this->post(route('boutique.commande.store'), $this->payload(['total' => 100]));

        $this->assertSame(2500, Order::sole()->total);
    }

    public function test_an_order_cannot_exceed_the_stock(): void
    {
        $this->fakeFeexPay();
        $this->post(route('boutique.panier.add', $this->product), ['quantity' => 2]);
        $this->product->update(['stock' => 1]);

        $this->post(route('boutique.commande.store'), $this->payload())->assertSessionHasErrors('payment_method');

        $this->assertSame(0, Order::count());
        $this->assertSame(1, $this->product->fresh()->stock);
    }

    public function test_a_failed_payment_releases_the_stock_only_once(): void
    {
        $this->fakeFeexPay();
        $order = $this->order();

        $this->assertSame(1, $this->product->fresh()->stock);

        $order->markPaymentFailed('LOW_BALANCE');
        $order->markPaymentFailed('LOW_BALANCE');
        Order::sole()->markPaymentFailed('LOW_BALANCE');

        $this->assertSame('failed', $order->fresh()->status);
        $this->assertSame(3, $this->product->fresh()->stock);
    }

    public function test_a_refused_payment_keeps_the_cart_and_releases_the_stock(): void
    {
        Http::fake(['sandbox-api.feexpay.me/*' => Http::response(['message' => 'refus'], 400)]);
        $this->post(route('boutique.panier.add', $this->product), ['quantity' => 2]);

        $this->post(route('boutique.commande.store'), $this->payload())->assertSessionHasErrors('payment_method');

        $this->assertSame('failed', Order::sole()->status);
        $this->assertSame(3, $this->product->fresh()->stock);
        $this->assertSame(2, app(\App\Support\Cart::class)->count());
    }

    public function test_the_webhook_confirms_an_order_after_checking_the_amount(): void
    {
        Http::fakeSequence('sandbox-api.feexpay.me/*')
            ->push(['reference' => 'ref-1', 'status' => 'PENDING'])
            ->push(['status' => 'SUCCESSFUL', 'amount' => 5000]);
        $order = $this->order();

        $this->withToken('secret')->post(route('webhooks.feexpay'), ['reference' => 'ref-1'])->assertOk();

        $this->assertSame('completed', $order->fresh()->status);
        $this->assertNotNull($order->fresh()->paid_at);
    }

    public function test_the_tracking_page_and_status_report_the_payment(): void
    {
        $this->fakeFeexPay();
        $order = $this->order();

        $this->get(route('boutique.suivi', $order->reference))->assertOk()->assertSee('Paiement en cours');
        $this->getJson(route('boutique.statut', $order->reference))->assertExactJson(['status' => 'pending', 'reason' => null]);
    }
}
