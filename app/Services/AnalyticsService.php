<?php

namespace App\Services;

use App\Models\PageView;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class AnalyticsService
{
    /**
     * @return array{views: int, visitors: int, sessions: int}
     */
    public function summary(CarbonInterface $from, CarbonInterface $to): array
    {
        $result = PageView::query()
            ->whereBetween('viewed_at', [$from, $to])
            ->selectRaw('COUNT(*) as views, COUNT(DISTINCT visitor_hash) as visitors, COUNT(DISTINCT session_id) as sessions')
            ->first();

        return [
            'views' => (int) ($result->views ?? 0),
            'visitors' => (int) ($result->visitors ?? 0),
            'sessions' => (int) ($result->sessions ?? 0),
        ];
    }

    /**
     * @return array{labels: list<string>, views: list<int>, visitors: list<int>}
     */
    public function dailyTraffic(CarbonInterface $from, CarbonInterface $to): array
    {
        $rows = PageView::query()
            ->whereBetween('viewed_at', [$from, $to])
            ->selectRaw('DATE(viewed_at) as day, COUNT(*) as views, COUNT(DISTINCT visitor_hash) as visitors')
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $labels = [];
        $views = [];
        $visitors = [];

        for ($day = CarbonImmutable::instance($from)->startOfDay(); $day->lessThanOrEqualTo($to); $day = $day->addDay()) {
            $key = $day->toDateString();

            $labels[] = $day->format('d/m');
            $views[] = (int) ($rows->get($key)->views ?? 0);
            $visitors[] = (int) ($rows->get($key)->visitors ?? 0);
        }

        return [
            'labels' => $labels,
            'views' => $views,
            'visitors' => $visitors,
        ];
    }

    /**
     * @return Collection<int, object{path: string, views: int, visitors: int}>
     */
    public function topPages(CarbonInterface $from, CarbonInterface $to, int $limit = 10): Collection
    {
        return PageView::query()
            ->whereBetween('viewed_at', [$from, $to])
            ->selectRaw('path, COUNT(*) as views, COUNT(DISTINCT visitor_hash) as visitors')
            ->groupBy('path')
            ->orderByDesc('views')
            ->limit($limit)
            ->get();
    }

    /**
     * @return Collection<int, object{referrer_host: string, views: int}>
     */
    public function topReferrers(CarbonInterface $from, CarbonInterface $to, int $limit = 5): Collection
    {
        return PageView::query()
            ->whereBetween('viewed_at', [$from, $to])
            ->whereNotNull('referrer_host')
            ->selectRaw('referrer_host, COUNT(*) as views')
            ->groupBy('referrer_host')
            ->orderByDesc('views')
            ->limit($limit)
            ->get();
    }

    /**
     * @return Collection<int, object{device_type: string, views: int}>
     */
    public function deviceBreakdown(CarbonInterface $from, CarbonInterface $to): Collection
    {
        return PageView::query()
            ->whereBetween('viewed_at', [$from, $to])
            ->selectRaw('device_type, COUNT(*) as views')
            ->groupBy('device_type')
            ->orderByDesc('views')
            ->get();
    }

    /**
     * @return Collection<int, object{browser: string, views: int}>
     */
    public function browserBreakdown(CarbonInterface $from, CarbonInterface $to, int $limit = 5): Collection
    {
        return PageView::query()
            ->whereBetween('viewed_at', [$from, $to])
            ->selectRaw('browser, COUNT(*) as views')
            ->groupBy('browser')
            ->orderByDesc('views')
            ->limit($limit)
            ->get();
    }

    /**
     * @return array{views: int, visitors: int, sessions: int}
     */
    public function today(): array
    {
        return $this->summary(now()->startOfDay(), now()->endOfDay());
    }

    /**
     * @return array{views: int, visitors: int, sessions: int}
     */
    public function lastThirtyDays(): array
    {
        return $this->summary(now()->subDays(29)->startOfDay(), now()->endOfDay());
    }

    public function comparisonWithPreviousPeriod(int $days): float
    {
        $current = $this->summary(now()->subDays($days - 1)->startOfDay(), now()->endOfDay())['views'];
        $previous = $this->summary(now()->subDays($days * 2 - 1)->startOfDay(), now()->subDays($days)->endOfDay())['views'];

        if ($previous === 0) {
            return $current > 0 ? 100.0 : 0.0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }
}
