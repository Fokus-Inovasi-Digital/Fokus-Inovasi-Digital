<?php

namespace App\Filament\Resources\Feedback\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                Select::make('type')
                    ->options([
            'bug' => 'Bug',
            'feature_request' => 'Feature request',
            'improvement' => 'Improvement',
            'compliment' => 'Compliment',
            'complaint' => 'Complaint',
            'other' => 'Other',
        ])
                    ->default('other')
                    ->required(),
                Select::make('status')
                    ->options(['new' => 'New', 'in_progress' => 'In progress', 'resolved' => 'Resolved', 'closed' => 'Closed'])
                    ->default('new')
                    ->required(),
            ]);
    }
}
