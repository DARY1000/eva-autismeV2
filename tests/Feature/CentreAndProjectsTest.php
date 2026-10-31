<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CentreAndProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_projects_page_lists_the_projects_and_links_the_centre(): void
    {
        $this->get(route('actions.projets'))
            ->assertOk()
            ->assertSee('Centre EVA Autisme')
            ->assertSee('Éco Sens')
            ->assertSee('/nos-actions/le-centre-eva');
    }

    public function test_the_centre_page_opens_and_says_it_is_not_a_state_programme(): void
    {
        $this->get(route('actions.centre'))
            ->assertOk()
            ->assertSee('Bénin 2060 Alafia')
            ->assertSee('Ce n\'est pas un programme de l\'État', false)
            ->assertDontSee('Alafia 2030');
    }
}
