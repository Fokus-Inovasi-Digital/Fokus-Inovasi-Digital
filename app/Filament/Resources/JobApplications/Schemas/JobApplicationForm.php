<?php

namespace App\Filament\Resources\JobApplications\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('career_id')
                    ->relationship('career', 'title')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('cv_file')
                    ->required(),
                TextInput::make('cover_letter_file'),
                TextInput::make('portfolio_file'),
                Textarea::make('additional_notes')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'reviewed' => 'Reviewed'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
