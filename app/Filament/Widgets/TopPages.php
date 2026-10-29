<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class TopPages extends TableWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $from = now()->subDays(29)->startOfDay();
        $to = now()->endOfDay();

        return $table
            ->heading('Páginas mais visitadas')
            ->description('Últimos 30 dias')
            ->query(
                PageView::query()
                    ->whereBetween('viewed_at', [$from, $to])
                    ->selectRaw('MIN(id) as id, path, COUNT(*) as views, COUNT(DISTINCT visitor_hash) as visitors')
                    ->groupBy('path')
                    ->orderByDesc('views')
                    ->limit(10),
            )
            ->columns([
                TextColumn::make('path')
                    ->label('Página')
                    ->limit(60)
                    ->searchable(false),
                TextColumn::make('views')
                    ->label('Visualizações')
                    ->numeric()
                    ->alignEnd(),
                TextColumn::make('visitors')
                    ->label('Visitantes')
                    ->numeric()
                    ->alignEnd(),
            ])
            ->paginated(false)
            ->defaultSort('views', 'desc');
    }
}
