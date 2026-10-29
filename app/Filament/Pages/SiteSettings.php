<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SiteSettings extends Page
{
    /**
     * @var list<string>
     */
    private const SETTING_KEYS = [
        'site_name',
        'tagline',
        'hero_title',
        'hero_subtitle',
        'about_title',
        'about_text',
        'email',
        'phone',
        'whatsapp',
        'address',
        'linkedin_url',
        'github_url',
        'instagram_url',
        'stat_projects',
        'stat_clients',
        'stat_years',
        'ga_measurement_id',
    ];

    protected static ?string $slug = 'configuracoes';

    protected static ?string $title = 'Configurações do site';

    protected static ?string $navigationLabel = 'Configurações';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|\UnitEnum|null $navigationGroup = 'Sistema';

    protected static ?int $navigationSort = 99;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $values = collect(self::SETTING_KEYS)
            ->mapWithKeys(fn (string $key): array => [$key => Setting::get($key) ?? ''])
            ->all();

        $this->form->fill($values);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identidade e conteúdo')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Nome do site')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('tagline')
                            ->label('Slogan')
                            ->maxLength(255),
                        TextInput::make('hero_title')
                            ->label('Título principal (home)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('hero_subtitle')
                            ->label('Subtítulo principal (home)')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('about_title')
                            ->label('Título da seção sobre')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('about_text')
                            ->label('Texto sobre a empresa')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Contato')
                    ->schema([
                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->maxLength(180),
                        TextInput::make('phone')
                            ->label('Telefone')
                            ->telRegex('/^[+0-9()\s.\-]+$/')
                            ->maxLength(30),
                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->helperText('Somente números, com DDI e DDD. Ex.: 5511999990000.')
                            ->maxLength(30),
                        TextInput::make('address')
                            ->label('Endereço')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Redes sociais')
                    ->schema([
                        TextInput::make('linkedin_url')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('github_url')
                            ->label('GitHub')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('instagram_url')
                            ->label('Instagram')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                Section::make('Números da empresa')
                    ->schema([
                        TextInput::make('stat_projects')
                            ->label('Sites vistoriados')
                            ->numeric(),
                        TextInput::make('stat_clients')
                            ->label('ERBs implantadas')
                            ->numeric(),
                        TextInput::make('stat_years')
                            ->label('Estados atendidos')
                            ->numeric(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                Section::make('Analytics')
                    ->schema([
                        TextInput::make('ga_measurement_id')
                            ->label('ID de mensuração do Google Analytics 4')
                            ->placeholder('G-XXXXXXXXXX')
                            ->helperText('Quando preenchido, a tag do GA4 é carregada automaticamente no site. As visitas também são registradas no módulo interno de analytics.')
                            ->maxLength(30),
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
            ->id('site-settings-form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make([
                    Action::make('save')
                        ->label('Salvar alterações')
                        ->icon('heroicon-o-check')
                        ->submit('save'),
                ])->key('site-settings-actions'),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Setting::setMany($data);

        Notification::make()
            ->title('Configurações salvas')
            ->success()
            ->send();
    }
}
