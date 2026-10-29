<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do contato')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->disabled(),
                        TextInput::make('company')
                            ->label('Empresa')
                            ->disabled(),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->disabled(),
                        TextInput::make('phone')
                            ->label('Telefone')
                            ->disabled(),
                        TextInput::make('service_interest')
                            ->label('Serviço de interesse')
                            ->disabled()
                            ->columnSpanFull(),
                        TextInput::make('ip_address')
                            ->label('IP de origem')
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Mensagem')
                    ->schema([
                        TextInput::make('subject')
                            ->label('Assunto')
                            ->disabled()
                            ->columnSpanFull(),
                        Textarea::make('message')
                            ->label('Mensagem')
                            ->rows(8)
                            ->disabled()
                            ->columnSpanFull(),
                        DateTimePicker::make('read_at')
                            ->label('Lida em')
                            ->disabled(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
