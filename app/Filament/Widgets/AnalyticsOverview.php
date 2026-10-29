<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Models\ContactMessage;
use App\Services\AnalyticsService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnalyticsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $heading = 'Visão geral';

    protected function getStats(): array
    {
        $today = app(AnalyticsService::class)->today();
        $lastThirtyDays = app(AnalyticsService::class)->lastThirtyDays();
        $lastSevenDays = app(AnalyticsService::class)->dailyTraffic(now()->subDays(6)->startOfDay(), now()->endOfDay());
        $comparison = app(AnalyticsService::class)->comparisonWithPreviousPeriod(30);

        return [
            Stat::make('Visitas hoje', number_format($today['views'], 0, ',', '.'))
                ->description($this->formatCount($today['visitors'], 'visitante único', 'visitantes únicos'))
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->icon('heroicon-o-eye')
                ->chart($lastSevenDays['views']),
            Stat::make('Visualizações (30 dias)', number_format($lastThirtyDays['views'], 0, ',', '.'))
                ->description($this->comparisonLabel($comparison))
                ->descriptionIcon($comparison >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->descriptionColor($comparison >= 0 ? 'success' : 'danger')
                ->color('primary')
                ->icon('heroicon-o-chart-bar')
                ->chart($lastSevenDays['views']),
            Stat::make('Visitantes únicos (30 dias)', number_format($lastThirtyDays['visitors'], 0, ',', '.'))
                ->description($this->formatCount($lastThirtyDays['sessions'], 'sessão', 'sessões'))
                ->descriptionIcon('heroicon-m-device-phone-mobile')
                ->color('success')
                ->icon('heroicon-o-user-group'),
            Stat::make('Mensagens não lidas', (string) ContactMessage::query()->unread()->count())
                ->description('Abrir caixa de entrada')
                ->descriptionIcon('heroicon-m-arrow-right')
                ->color('warning')
                ->icon('heroicon-o-envelope')
                ->url(ContactMessageResource::getUrl('index')),
        ];
    }

    private function comparisonLabel(float $comparison): string
    {
        $prefix = $comparison >= 0 ? '+' : '';

        return $prefix.number_format($comparison, 1, ',', '.').'% vs. período anterior';
    }

    private function formatCount(int $count, string $singular, string $plural): string
    {
        return number_format($count, 0, ',', '.').' '.($count === 1 ? $singular : $plural);
    }
}
