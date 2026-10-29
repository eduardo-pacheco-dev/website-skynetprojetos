<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Service;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitePagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SettingSeeder::class);
    }

    public function test_home_page_lists_active_services_and_featured_projects(): void
    {
        $service = Service::factory()->create(['is_active' => true]);
        $project = Project::factory()->featured()->create(['is_active' => true]);
        Service::factory()->inactive()->create();

        $this->get('/')
            ->assertOk()
            ->assertSee($service->title)
            ->assertSee($project->title)
            ->assertSee('SkyNet Projetos');
    }

    public function test_services_pages_are_accessible(): void
    {
        $service = Service::factory()->create(['is_active' => true]);

        $this->get(route('services.index'))
            ->assertOk()
            ->assertSee($service->title);

        $this->get(route('services.show', $service))
            ->assertOk()
            ->assertSee($service->summary);
    }

    public function test_inactive_services_are_not_accessible(): void
    {
        $service = Service::factory()->inactive()->create();

        $this->get(route('services.show', $service))->assertNotFound();
    }

    public function test_projects_pages_are_accessible(): void
    {
        $project = Project::factory()->create(['is_active' => true]);

        $this->get(route('projects.index'))
            ->assertOk()
            ->assertSee($project->title);

        $this->get(route('projects.show', $project))
            ->assertOk()
            ->assertSee($project->summary);
    }

    public function test_inactive_projects_are_not_accessible(): void
    {
        $project = Project::factory()->inactive()->create();

        $this->get(route('projects.show', $project))->assertNotFound();
    }

    public function test_about_and_contact_pages_are_accessible(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Sobre a SkyNet');

        $this->get(route('contact.create'))
            ->assertOk()
            ->assertSee('Enviar solicitação');
    }
}
