<?php

namespace Tests\Feature;

use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_riaco_2026_is_listed_by_year_and_has_its_page(): void
    {
        $this->get(route('actions.activites'))->assertOk()->assertSee('2026')->assertSee('RIACO 2026');
        $this->get(route('actions.activites.show', 'riaco-2026'))->assertOk()->assertSee('26 au 30 octobre 2026');
    }

    public function test_the_year_filter_hides_other_years(): void
    {
        $this->get(route('actions.activites', ['annee' => 2024]))->assertOk()->assertDontSee('RIACO 2026 : Rencontre');
    }

    public function test_a_draft_stays_private(): void
    {
        Activity::create([
            'title' => 'Brouillon', 'category' => 'autre', 'summary' => 'x', 'start_date' => '2026-01-01', 'is_published' => false,
        ]);

        $this->get(route('actions.activites.show', 'brouillon'))->assertNotFound();
    }
}
