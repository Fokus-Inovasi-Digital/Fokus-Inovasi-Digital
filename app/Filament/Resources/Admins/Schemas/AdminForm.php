<?php

namespace App\Filament\Resources\Admins\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AdminForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                DateTimePicker::make('email_verified_at')
                    ->label('Verified At')
                    ->nullable(),
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->maxLength(255)
                    ->label('Password'),
                Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                    ])
                    ->default('admin')
                    ->disabled()->dehydrated(true),
            ]);
    }
}
