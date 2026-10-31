<?php

namespace Tests\Feature;

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

        $urls = collect(Filament::getPanel('admin')->getResources())
            ->flatMap(function (string $resource) {
                return $resource::hasPage('create')
                    ? [$resource::getUrl('index'), $resource::getUrl('create')]
                    : [$resource::getUrl('index')];
            })
            ->merge([url('/admin'), url('/admin/site-settings-page'), url('/admin/profile')]);

        foreach ($urls as $url) {
            $this->assertSame(200, $this->get($url)->getStatusCode(), $url);
        }
    }
}
