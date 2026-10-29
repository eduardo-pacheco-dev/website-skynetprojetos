<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do projeto')
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
                            ->unique(ignoreRecord: true),
                        TextInput::make('client')
                            ->label('Cliente')
                            ->maxLength(255),
                        DatePicker::make('completed_at')
                            ->label('Data de conclusão')
                            ->displayFormat('d/m/Y'),
                        TextInput::make('summary')
                            ->label('Resumo')
                            ->required()
                            ->maxLength(300)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(8)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Mídia e links')
                    ->schema([
                        FileUpload::make('cover_image')
                            ->label('Imagem de capa')
                            ->image()
                            ->disk('public')
                            ->directory('projects')
                            ->imageEditor()
                            ->maxSize(4096)
                            ->columnSpanFull(),
                        TextInput::make('project_url')
                            ->label('Link do projeto')
                            ->url()
                            ->maxLength(255),
                        TagsInput::make('technologies')
                            ->label('Tecnologias')
                            ->placeholder('Adicione uma tecnologia')
                            ->reorderable(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Publicação')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Ativo no site')
                            ->default(true),
                        Toggle::make('is_featured')
                            ->label('Destacado na home')
                            ->default(false),
                        TextInput::make('sort_order')
                            ->label('Ordem de exibição')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
