<?php

namespace Tests\Feature;

use App\Filament\Pages\ConstructionPage;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ConstructionPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_the_construction_page_content(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ConstructionPage::class)
            ->set('data.construction_enabled', true)
            ->set('data.construction_title', 'Novo site em breve')
            ->set('data.construction_message', 'Mensagem personalizada para os visitantes.')
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame('1', Setting::get('construction_enabled'));
        $this->assertSame('Novo site em breve', Setting::get('construction_title'));

        $this->get('/')
            ->assertOk()
            ->assertSee('Novo site em breve')
            ->assertSee('Mensagem personalizada para os visitantes.');
    }

    public function test_admin_can_disable_the_construction_page(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ConstructionPage::class)
            ->set('data.construction_enabled', false)
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame('0', Setting::get('construction_enabled'));

        $this->get('/')->assertNotFound();
    }
}
