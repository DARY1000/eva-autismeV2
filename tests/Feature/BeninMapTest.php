<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Support\BeninDepartments;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeninMapTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_map_has_the_twelve_departments_of_benin(): void
    {
        $this->assertCount(12, BeninDepartments::map()['departments']);

        $this->get(route('about.impact'))->assertOk()->assertSee('Présents dans 4 départements sur 12');
    }

    public function test_the_admin_setting_replaces_the_default_status(): void
    {
        SiteSetting::set('dept_status_zou', 'expansion');
        SiteSetting::set('dept_note_zou', 'Abomey : ateliers parents');

        $this->assertSame('expansion', BeninDepartments::all()['departments']['zou']['status']);
        $this->get(route('about.impact'))->assertSee('Abomey : ateliers parents')->assertSee('Présents dans 5 départements sur 12');
    }
}
