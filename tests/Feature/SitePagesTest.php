<?php

namespace Tests\Feature;

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

    public function test_only_the_under_construction_page_is_available(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Site em construção')
            ->assertSee('Estamos preparando')
            ->assertSee('Skynet Projetos e Consultoria')
            ->assertSee('68.340.372/0001-09')
            ->assertSee('Em breve');
    }

    public function test_all_previous_site_pages_were_removed(): void
    {
        $this->get('/servicos')->assertNotFound();
        $this->get('/projetos')->assertNotFound();
        $this->get('/sobre')->assertNotFound();
        $this->get('/contato')->assertNotFound();
        $this->post('/contato')->assertNotFound();
    }
}
