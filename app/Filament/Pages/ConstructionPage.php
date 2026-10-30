<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConstructionPage extends Page
{
    protected static ?string $slug = 'pagina-em-construcao';

    protected static ?string $title = 'Página em construção';

    protected static ?string $navigationLabel = 'Página em construção';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static string|\UnitEnum|null $navigationGroup = 'Sistema';

    protected static ?int $navigationSort = 90;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'construction_enabled' => Setting::get('construction_enabled', '1') === '1',
            'construction_title' => Setting::get('construction_title', 'Nosso novo site está em construção.'),
            'construction_message' => Setting::get('construction_message', 'Estamos preparando uma nova experiência digital para apresentar nossas soluções em engenharia de telecomunicações, rollout documental e qualidade.'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Publicação')
                    ->schema([
                        Toggle::make('construction_enabled')
                            ->label('Exibir página em construção')
                            ->helperText('Quando desativada, o site público responde 404 até que o site definitivo seja publicado.')
                            ->default(true),
                    ])
                    ->columnSpanFull(),
                Section::make('Conteúdo da página')
                    ->schema([
                        TextInput::make('construction_title')
                            ->label('Título')
                            ->required()
                            ->maxLength(160)
                            ->columnSpanFull(),
                        Textarea::make('construction_message')
                            ->label('Mensagem')
                            ->required()
                            ->rows(5)
                            ->maxLength(600)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),
            ]);
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('construction-page-form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make([
                    Action::make('save')
                        ->label('Salvar alterações')
                        ->icon('heroicon-o-check')
                        ->submit('save'),
                ])->key('construction-page-actions'),
            ]);
    }

    /**
     * @return array<Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Ver página')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->url(route('home'))
                ->openUrlInNewTab(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Setting::setMany([
            'construction_enabled' => $data['construction_enabled'] ? '1' : '0',
            'construction_title' => $data['construction_title'],
            'construction_message' => $data['construction_message'],
        ]);

        Notification::make()
            ->title('Página em construção atualizada')
            ->success()
            ->send();
    }
}
