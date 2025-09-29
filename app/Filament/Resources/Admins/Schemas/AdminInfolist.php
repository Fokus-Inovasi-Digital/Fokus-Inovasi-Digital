<?php

namespace App\Filament\Resources\Admins\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdminInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Admin Details')
                    ->columns(2)
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        TextEntry::make('name')
                            ->icon('heroicon-o-user'),
                        TextEntry::make('email')
                            ->label('Email Address')
                            ->icon('heroicon-o-envelope'),
                        TextEntry::make('role')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'admin' => 'primary',
                                default => 'gray',
                            }),
                    ]),
                Section::make('Account Status & Metadata')
                    ->columns(3)
                    ->collapsed()
                    ->icon('heroicon-o-clock')
                    ->schema([
                        TextEntry::make('email_verified_at')
                            ->label('Email Verified At')
                            ->dateTime()
                            ->placeholder('Not verified')
                            ->icon(fn($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn($state) => $state ? 'success' : 'danger'),
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime()
                            ->placeholder('-')
                            ->icon('heroicon-o-calendar-days'),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime()
                            ->placeholder('-')
                            ->icon('heroicon-o-pencil-square'),
                    ]),
            ]);
    }
}
