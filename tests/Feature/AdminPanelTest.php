<?php

namespace Tests\Feature;

use App\Filament\Widgets\AnalyticsOverview;
use App\Filament\Widgets\DeviceChart;
use App\Filament\Widgets\TopPages;
use App\Filament\Widgets\TrafficChart;
use App\Models\ContactMessage;
use App\Models\PageView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_authenticated_users_can_access_the_admin_panel(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin')->assertOk();
    }

    public function test_admin_pages_are_accessible(): void
    {
        $user = User::factory()->create();

        $routes = [
            '/admin/analytics',
            '/admin/services',
            '/admin/services/create',
            '/admin/projects',
            '/admin/projects/create',
            '/admin/contact-messages',
            '/admin/configuracoes',
        ];

        foreach ($routes as $route) {
            $this->actingAs($user)->get($route)->assertOk();
        }
    }

    public function test_outsiders_cannot_access_the_admin_panel(): void
    {
        $this->assertGuest();

        $this->get('/admin/services')->assertRedirect('/admin/login');
    }

    public function test_analytics_dashboard_renders_with_tracking_data(): void
    {
        PageView::factory()->count(10)->create([
            'path' => '/servicos',
            'viewed_at' => now(),
        ]);
        ContactMessage::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin/analytics')
            ->assertOk()
            ->assertSee('Analytics');

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk();

        Livewire::actingAs($user)
            ->test(AnalyticsOverview::class)
            ->assertOk()
            ->assertSee('Visitas hoje');

        Livewire::actingAs($user)
            ->test(TrafficChart::class)
            ->assertOk();

        Livewire::actingAs($user)
            ->test(DeviceChart::class)
            ->assertOk();

        Livewire::actingAs($user)
            ->test(TopPages::class)
            ->assertOk()
            ->assertSee('/servicos');
    }
}
