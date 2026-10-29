<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestContactMessages extends TableWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Últimas mensagens recebidas')
            ->query(ContactMessage::query()->latest()->limit(5))
            ->columns([
                IconColumn::make('read_at')
                    ->label('Lida')
                    ->boolean(),
                TextColumn::make('name')
                    ->label('Nome'),
                TextColumn::make('subject')
                    ->label('Assunto')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Recebida em')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Abrir')
                    ->url(fn (ContactMessage $record): string => ContactMessageResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
