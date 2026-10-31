<?php

namespace Tests\Feature;

use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DonationPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.feexpay' => [
            'shop_id' => 'shop_test', 'api_key' => 'test_key_x', 'mode' => 'sandbox', 'webhook_secret' => 'secret',
        ]]);
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'montant' => 5000, 'frequence' => 'ponctuel', 'prenom' => 'Amina', 'nom' => 'Dossou',
            'email' => 'amina@example.org', 'telephone' => '01 97 00 00 00', 'pays' => 'BJ', 'payment_method' => 'mtn',
            '_form_ts' => Crypt::encryptString((string) (time() - 30)),
        ], $overrides);
    }

    private function pendingDonation(): Donation
    {
        return Donation::create([
            'prenom' => 'A', 'nom' => 'B', 'email' => 'a@b.co', 'telephone' => '0197000000', 'montant' => 5000,
            'frequence' => 'ponctuel', 'status' => 'pending', 'payment_method' => 'mtn', 'payment_reference' => 'ref-1',
        ]);
    }

    public function test_a_mobile_money_donation_starts_a_feexpay_payment(): void
    {
        Http::fake(['sandbox-api.feexpay.me/*' => Http::response(['reference' => 'ref-1', 'status' => 'PENDING'])]);

        $response = $this->post(route('don.process'), $this->payload());

        $donation = Donation::sole();
        $response->assertRedirect(route('don.track', $donation->reference));
        $this->assertSame('ref-1', $donation->payment_reference);

        Http::assertSent(fn ($request) => str_ends_with($request->url(), '/requesttopay/mtn')
            && $request['phoneNumber'] === '2290197000000'
            && $request['amount'] === 5000
            && $request->hasHeader('Authorization', 'Bearer test_key_x'));
    }

    public function test_an_invalid_phone_is_refused_before_calling_feexpay(): void
    {
        Http::fake();

        $this->post(route('don.process'), $this->payload(['telephone' => '97000000']))->assertSessionHasErrors('telephone');

        Http::assertNothingSent();
        $this->assertSame(0, Donation::count());
    }

    public function test_a_donor_can_give_from_100_cfa_but_not_less(): void
    {
        Http::fake(['sandbox-api.feexpay.me/*' => Http::response(['reference' => 'ref-1', 'status' => 'PENDING'])]);

        $this->post(route('don.process'), $this->payload(['montant' => 99]))->assertSessionHasErrors('montant');
        $this->assertSame(0, Donation::count());

        $this->post(route('don.process'), $this->payload(['montant' => 100]))->assertSessionHasNoErrors();
        $this->assertEquals(100, Donation::sole()->montant);
    }

    public function test_a_togolese_donor_pays_with_a_network_of_their_country(): void
    {
        Http::fake(['sandbox-api.feexpay.me/*' => Http::response(['reference' => 'ref-1', 'status' => 'PENDING'])]);

        $this->post(route('don.process'), $this->payload([
            'pays' => 'TG', 'telephone' => '90 12 34 56', 'payment_method' => 'togocom_tg',
        ]))->assertSessionHasNoErrors();

        $this->assertSame('Togo', Donation::sole()->pays);
        Http::assertSent(fn ($request) => str_ends_with($request->url(), '/requesttopay/togocom_tg')
            && $request['phoneNumber'] === '22890123456');
    }

    public function test_a_network_from_another_country_is_refused(): void
    {
        Http::fake();

        $this->post(route('don.process'), $this->payload(['pays' => 'SN', 'telephone' => '77 123 45 67']))
            ->assertSessionHasErrors('payment_method');

        Http::assertNothingSent();
    }

    public function test_wave_sends_the_donor_to_the_operator_page_and_back(): void
    {
        Http::fake(['sandbox-api.feexpay.me/*' => Http::response([
            'reference' => 'ref-1', 'status' => 'PENDING', 'payment_url' => 'https://pay.wave.com/c/test',
        ])]);

        $this->post(route('don.process'), $this->payload([
            'pays' => 'SN', 'telephone' => '77 123 45 67', 'payment_method' => 'wave_sn',
        ]))->assertRedirect('https://pay.wave.com/c/test');

        $track = route('don.track', Donation::sole()->reference);
        Http::assertSent(fn ($request) => $request['return_url'] === $track && $request['phoneNumber'] === '221771234567');
    }

    public function test_a_network_disabled_in_settings_is_refused(): void
    {
        config(['services.feexpay.disabled_networks' => ['wave_sn']]);
        Http::fake();

        $this->post(route('don.process'), $this->payload([
            'pays' => 'SN', 'telephone' => '77 123 45 67', 'payment_method' => 'wave_sn',
        ]))->assertSessionHasErrors('payment_method');

        Http::assertNothingSent();
    }

    public function test_a_foreign_currency_amount_is_never_charged_in_cfa(): void
    {
        Http::fake();

        $this->post(route('don.process'), $this->payload(['devise' => 'EUR']))->assertSessionHasErrors('montant');

        Http::assertNothingSent();
    }

    public function test_the_webhook_confirms_only_after_checking_feexpay(): void
    {
        Http::fake(['*/single/status/ref-1' => Http::response(['status' => 'SUCCESSFUL', 'amount' => 5000])]);
        $donation = $this->pendingDonation();

        $this->withToken('secret')->postJson('/webhooks/feexpay', ['reference' => 'ref-1'])->assertOk();

        $this->assertSame('completed', $donation->fresh()->status);
        $this->assertNotNull($donation->fresh()->paid_at);
    }

    public function test_a_forged_webhook_cannot_confirm_a_donation(): void
    {
        Http::fake(['*/single/status/ref-1' => Http::response(['status' => 'PENDING', 'amount' => 5000])]);
        $donation = $this->pendingDonation();

        $this->postJson('/webhooks/feexpay', ['reference' => 'ref-1', 'status' => 'SUCCESSFUL'])->assertUnauthorized();
        $this->withToken('secret')->postJson('/webhooks/feexpay', ['reference' => 'ref-1', 'status' => 'SUCCESSFUL'])->assertOk();

        $this->assertSame('pending', $donation->fresh()->status);
    }

    public function test_an_underpaid_transaction_does_not_confirm_the_donation(): void
    {
        Http::fake(['*/single/status/ref-1' => Http::response(['status' => 'SUCCESSFUL', 'amount' => 100])]);
        $donation = $this->pendingDonation();

        $this->withToken('secret')->postJson('/webhooks/feexpay', ['reference' => 'ref-1'])->assertOk();

        $this->assertSame('failed', $donation->fresh()->status);
    }

    public function test_the_status_endpoint_gives_the_reason_of_a_failure(): void
    {
        Http::fake(['*/single/status/ref-1' => Http::response([
            'status' => 'FAILED', 'amount' => 5000, 'reason' => 'LOW_BALANCE_OR_PAYEE_LIMIT_REACHED_OR_NOT_ALLOWED',
        ])]);
        $donation = $this->pendingDonation();

        $this->getJson(route('don.status', $donation->reference))->assertExactJson([
            'status' => 'failed',
            'reason' => 'Votre solde est insuffisant ou votre plafond est atteint.',
        ]);
    }

    public function test_reloading_the_tracking_page_confirms_a_paid_donation(): void
    {
        Http::fake(['*/single/status/ref-1' => Http::response(['status' => 'SUCCESSFUL', 'amount' => 5000])]);
        $donation = $this->pendingDonation();

        $this->get(route('don.track', $donation->reference))->assertOk()->assertSee('Paiement réussi');

        $this->assertSame('completed', $donation->fresh()->status);
    }

    public function test_feexpay_being_down_asks_for_a_webhook_retry(): void
    {
        Http::fake(['*/single/status/ref-1' => Http::response('', 500)]);
        $this->pendingDonation();

        $this->withToken('secret')->postJson('/webhooks/feexpay', ['reference' => 'ref-1'])->assertStatus(503);
    }

    public function test_without_keys_the_donation_is_recorded_for_manual_follow_up(): void
    {
        config(['services.feexpay.api_key' => null]);
        Http::fake();

        $this->post(route('don.process'), $this->payload())->assertSessionHas('success');

        Http::assertNothingSent();
        $this->assertSame('pending', Donation::sole()->status);
    }
}
