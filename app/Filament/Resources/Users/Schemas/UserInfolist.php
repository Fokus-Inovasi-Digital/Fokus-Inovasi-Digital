<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('User Profile')
                    ->columns(2)
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Full Name')
                            ->icon('heroicon-o-user'),
                        TextEntry::make('email')
                            ->label('Email Address')
                            ->icon('heroicon-o-envelope'),
                        TextEntry::make('role')
                            ->label('User Role')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'admin' => 'danger',
                                'user' => 'success',
                                default => 'gray',
                            })
                            ->icon('heroicon-o-finger-print'),
                        TextEntry::make('phone')
                            ->placeholder('-')
                            ->label('Phone Number')
                            ->icon('heroicon-o-phone'),
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
                            ->label('Last Updated')
                            ->dateTime()
                            ->placeholder('-')
                            ->icon('heroicon-o-pencil-square'),
                    ]),
            ]);
    }
}