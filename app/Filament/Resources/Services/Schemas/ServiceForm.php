<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do serviço')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, callable $set): void {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug((string) $state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Endereço amigável usado na URL. Ex.: desenvolvimento-web.'),
                        Select::make('icon')
                            ->label('Ícone')
                            ->options([
                                'code' => 'Código',
                                'automation' => 'Automação',
                                'cloud' => 'Nuvem / Integrações',
                                'mobile' => 'Dispositivo móvel',
                                'chart' => 'Gráficos / Consultoria',
                                'shield' => 'Segurança',
                            ])
                            ->native(false),
                        TextInput::make('summary')
                            ->label('Resumo')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(6)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Publicação')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Ativo no site')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Ordem de exibição')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
