<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;

class TrafficChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Tráfego do site';

    protected ?string $description = 'Visualizações e visitantes únicos por dia.';

    protected int|string|array $columnSpan = 'full';

    protected ?string $maxHeight = '320px';

    public ?string $filter = '30';

    protected function getFilters(): ?array
    {
        return [
            7 => 'Últimos 7 dias',
            30 => 'Últimos 30 dias',
            90 => 'Últimos 90 dias',
        ];
    }

    protected function getData(): array
    {
        $days = (int) ($this->filter ?? 30);
        $traffic = app(AnalyticsService::class)->dailyTraffic(
            now()->subDays($days - 1)->startOfDay(),
            now()->endOfDay(),
        );

        return [
            'datasets' => [
                [
                    'label' => 'Visualizações',
                    'data' => $traffic['views'],
                    'borderColor' => '#06b6d4',
                    'backgroundColor' => 'rgba(6, 182, 212, 0.15)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Visitantes únicos',
                    'data' => $traffic['visitors'],
                    'borderColor' => '#8b5cf6',
                    'backgroundColor' => 'rgba(139, 92, 246, 0.12)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $traffic['labels'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
