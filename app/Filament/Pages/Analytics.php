<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AnalyticsOverview;
use App\Filament\Widgets\DeviceChart;
use App\Filament\Widgets\TopPages;
use App\Filament\Widgets\TrafficChart;
use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Dashboard;
use Filament\Support\Icons\Heroicon;

class Analytics extends Dashboard
{
    protected static string $routePath = '/analytics';

    protected static ?string $title = 'Analytics';

    protected static ?string $navigationLabel = 'Analytics';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static string|\UnitEnum|null $navigationGroup = 'Analytics';

    protected static ?int $navigationSort = 1;

    public function getWidgets(): array
    {
        return [
            AnalyticsOverview::class,
            TrafficChart::class,
            DeviceChart::class,
            TopPages::class,
        ];
    }

    /**
     * @return array<Action>
     */
    protected function getHeaderActions(): array
    {
        if (blank(Setting::get('ga_measurement_id'))) {
            return [];
        }

        return [
            Action::make('googleAnalytics')
                ->label('Abrir Google Analytics')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->url('https://analytics.google.com/')
                ->openUrlInNewTab(),
        ];
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
