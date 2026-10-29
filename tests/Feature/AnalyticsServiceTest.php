<?php

namespace Tests\Feature;

use App\Models\PageView;
use App\Services\AnalyticsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AnalyticsServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_summary_counts_views_and_unique_visitors(): void
    {
        PageView::factory()->create([
            'visitor_hash' => 'visitor-a',
            'session_id' => 'session-a',
            'viewed_at' => now(),
        ]);
        PageView::factory()->create([
            'visitor_hash' => 'visitor-a',
            'session_id' => 'session-a',
            'viewed_at' => now(),
        ]);
        PageView::factory()->create([
            'visitor_hash' => 'visitor-b',
            'session_id' => 'session-b',
            'viewed_at' => now(),
        ]);

        $summary = app(AnalyticsService::class)->summary(now()->startOfDay(), now()->endOfDay());

        $this->assertSame(3, $summary['views']);
        $this->assertSame(2, $summary['visitors']);
        $this->assertSame(2, $summary['sessions']);
    }

    public function test_daily_traffic_fills_days_without_visits(): void
    {
        PageView::factory()->create(['viewed_at' => now()]);
        PageView::factory()->create(['viewed_at' => now()->subDays(2)]);

        $traffic = app(AnalyticsService::class)->dailyTraffic(
            now()->subDays(3)->startOfDay(),
            now()->endOfDay(),
        );

        $this->assertCount(4, $traffic['labels']);
        $this->assertCount(4, $traffic['views']);
        $this->assertSame(1, $traffic['views'][1]);
        $this->assertSame(0, $traffic['views'][2]);
        $this->assertSame(1, $traffic['views'][3]);
    }

    public function test_top_pages_are_ordered_by_views(): void
    {
        PageView::factory()->count(3)->create(['path' => '/servicos', 'viewed_at' => now()]);
        PageView::factory()->count(1)->create(['path' => '/contato', 'viewed_at' => now()]);

        $topPages = app(AnalyticsService::class)->topPages(now()->startOfDay(), now()->endOfDay());

        $this->assertSame('/servicos', $topPages->first()->path);
        $this->assertSame(3, (int) $topPages->first()->views);
    }

    public function test_traffic_comparison_handles_empty_previous_period(): void
    {
        PageView::factory()->create(['viewed_at' => now()]);

        $comparison = app(AnalyticsService::class)->comparisonWithPreviousPeriod(7);

        $this->assertSame(100.0, $comparison);
    }

    public function test_views_from_previous_periods_are_excluded(): void
    {
        PageView::factory()->create(['viewed_at' => now()]);
        PageView::factory()->create(['viewed_at' => Carbon::now()->subDays(40)]);

        $summary = app(AnalyticsService::class)->summary(now()->subDays(29)->startOfDay(), now()->endOfDay());

        $this->assertSame(1, $summary['views']);
    }

    public function test_page_views_older_than_the_retention_period_are_pruned(): void
    {
        $oldPageView = PageView::factory()->create(['viewed_at' => now()->subDays(400)]);
        $recentPageView = PageView::factory()->create(['viewed_at' => now()]);

        $this->artisan('model:prune', ['--model' => [PageView::class]])
            ->assertSuccessful();

        $this->assertDatabaseMissing('page_views', ['id' => $oldPageView->id]);
        $this->assertDatabaseHas('page_views', ['id' => $recentPageView->id]);
    }
}
