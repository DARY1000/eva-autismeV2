<?php

namespace Tests\Feature;

use App\Filament\Resources\OrderResource;
use App\Models\Donation;
use App\Models\Order;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_admin_page_opens(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']));

        // Les colonnes ne s'évaluent qu'avec des lignes : une liste vide masquerait leurs erreurs.
        Donation::create(['prenom' => 'A', 'nom' => 'B', 'email' => 'a@b.co', 'telephone' => '0197000000', 'montant' => 5000, 'frequence' => 'ponctuel', 'status' => 'pending']);
        $order = Order::create(['reference' => 'CMD-TEST', 'prenom' => 'A', 'nom' => 'B', 'email' => 'a@b.co', 'telephone' => '0197000000', 'pays' => 'Bénin', 'ville' => 'Cotonou', 'delivery_mode' => 'retrait', 'total' => 5000]);
        $order->items()->create(['name' => 'Minuteur', 'unit_price' => 5000, 'quantity' => 1]);

        $urls = collect(Filament::getPanel('admin')->getResources())
            ->flatMap(function (string $resource) {
                return $resource::hasPage('create')
                    ? [$resource::getUrl('index'), $resource::getUrl('create')]
                    : [$resource::getUrl('index')];
            })
            ->merge([url('/admin'), url('/admin/site-settings-page'), url('/admin/profile'), OrderResource::getUrl('edit', ['record' => $order])]);

        foreach ($urls as $url) {
            $this->assertSame(200, $this->get($url)->getStatusCode(), $url);
        }
    }
}
