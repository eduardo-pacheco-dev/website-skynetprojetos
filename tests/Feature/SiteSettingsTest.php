<?php

namespace Tests\Feature;

use App\Filament\Pages\SiteSettings;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SiteSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_site_settings(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(SiteSettings::class)
            ->fillForm([
                'site_name' => 'SkyNet Atualizado',
                'tagline' => 'Nova tagline',
                'hero_title' => 'Novo título',
                'hero_subtitle' => 'Novo subtítulo',
                'about_title' => 'Sobre atualizado',
                'about_text' => 'Novo texto sobre a empresa.',
                'email' => 'novo@skynetprojetos.com.br',
                'phone' => '+55 (11) 98888-0000',
                'whatsapp' => '5511988880000',
                'address' => 'Rio de Janeiro, RJ',
                'linkedin_url' => 'https://www.linkedin.com/company/skynet',
                'github_url' => 'https://github.com/skynet',
                'instagram_url' => 'https://www.instagram.com/skynet',
                'stat_projects' => '120',
                'stat_clients' => '60',
                'stat_years' => '12',
                'ga_measurement_id' => 'G-TEST12345',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame('SkyNet Atualizado', Setting::get('site_name'));
        $this->assertSame('G-TEST12345', Setting::get('ga_measurement_id'));

        $this->get('/')
            ->assertOk()
            ->assertSee('SkyNet Atualizado');
    }
}
