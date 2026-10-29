<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;

class DeviceChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Dispositivos';

    protected ?string $description = 'Acessos por tipo de dispositivo nos últimos 30 dias.';

    protected ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $breakdown = app(AnalyticsService::class)
            ->deviceBreakdown(now()->subDays(29)->startOfDay(), now()->endOfDay())
            ->keyBy('device_type');

        return [
            'datasets' => [
                [
                    'label' => 'Acessos',
                    'data' => [
                        (int) ($breakdown->get('desktop')->views ?? 0),
                        (int) ($breakdown->get('mobile')->views ?? 0),
                        (int) ($breakdown->get('tablet')->views ?? 0),
                    ],
                    'backgroundColor' => ['#06b6d4', '#8b5cf6', '#f59e0b'],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => ['Desktop', 'Mobile', 'Tablet'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'cutout' => '65%',
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
