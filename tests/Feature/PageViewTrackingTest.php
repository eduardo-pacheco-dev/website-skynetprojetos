<?php

namespace Tests\Feature;

use App\Models\PageView;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageViewTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_views_are_recorded(): void
    {
        $this->get('/')->assertOk();

        $this->assertDatabaseCount('page_views', 1);

        $pageView = PageView::query()->firstOrFail();

        $this->assertSame('/', $pageView->path);
        $this->assertSame('home', $pageView->route_name);
        $this->assertSame('desktop', $pageView->device_type);
        $this->assertNotNull($pageView->visitor_hash);
        $this->assertNotNull($pageView->viewed_at);
    }

    public function test_non_get_requests_are_not_recorded(): void
    {
        $this->post('/contato', [])->assertNotFound();

        $this->assertDatabaseCount('page_views', 0);
    }

    public function test_admin_requests_are_not_recorded(): void
    {
        $this->get('/admin')->assertRedirect();

        $this->assertDatabaseCount('page_views', 0);
    }

    public function test_bots_are_not_recorded(): void
    {
        $this->withHeader('User-Agent', 'Mozilla/5.0 (compatible; Googlebot/2.1)')
            ->get('/')
            ->assertOk();

        $this->assertDatabaseCount('page_views', 0);
    }

    public function test_do_not_track_requests_are_not_recorded(): void
    {
        $this->withHeader('DNT', '1')
            ->get('/')
            ->assertOk();

        $this->assertDatabaseCount('page_views', 0);
    }

    public function test_external_referrers_are_recorded_but_internal_ones_are_ignored(): void
    {
        $this->withHeader('Referer', 'https://www.google.com/search?q=skynet')
            ->get('/')
            ->assertOk();

        $this->assertDatabaseHas('page_views', [
            'referrer_host' => 'www.google.com',
        ]);

        $this->withHeader('Referer', config('app.url').'/#inicio')
            ->get('/?origem=interno')
            ->assertOk();

        $this->assertDatabaseCount('page_views', 2);
        $this->assertDatabaseHas('page_views', [
            'path' => '/',
            'referrer_host' => null,
        ]);
    }

    public function test_mobile_visitors_are_detected(): void
    {
        $this->withHeader('User-Agent', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1')
            ->get('/')
            ->assertOk();

        $this->assertDatabaseHas('page_views', [
            'device_type' => 'mobile',
            'browser' => 'Safari',
            'platform' => 'iOS',
        ]);
    }
}
