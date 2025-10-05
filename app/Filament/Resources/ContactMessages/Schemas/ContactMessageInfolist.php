<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Contact Information')
                    ->icon('heroicon-o-user-circle')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->placeholder('-')
                            ->icon('heroicon-o-user'),
                        TextEntry::make('email')
                            ->label('Email address')
                            ->placeholder('-')->copyable()
                            ->icon('heroicon-o-envelope'),
                        TextEntry::make('phone')
                            ->placeholder('-')->copyable()
                            ->icon('heroicon-o-phone'),
                        TextEntry::make('company')
                            ->placeholder('-')
                            ->icon('heroicon-o-building-office'),
                    ]),
                Section::make('Message Details')
                    ->icon('heroicon-o-document-text')
                    ->columns(1)
                    ->schema([
                        TextEntry::make('subject')
                            ->placeholder('-')
                            ->icon('heroicon-o-tag'),
                        TextEntry::make('message')
                            ->columnSpanFull()
                            ->placeholder('-')
                            ->icon('heroicon-o-chat-bubble-left-ellipsis')
                            ->html(),
                    ]),
                Section::make('Status & IP Information')
                    ->icon('heroicon-o-information-circle')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'new' => 'primary',
                                default => 'gray',
                            }),
                        TextEntry::make('ip_address')
                            ->label('IP Address')
                            ->placeholder('-')
                            ->icon('heroicon-o-globe-alt'),
                    ]),
                Section::make('User Agent Info')
                    ->icon('heroicon-o-computer-desktop')
                    ->columns(1)
                    ->schema([
                        TextEntry::make('user_agent')
                            ->label('User Agent')
                            ->columnSpanFull()
                            ->placeholder('-')
                            ->icon('heroicon-o-device-phone-mobile')
                            ->html(),
                    ]),
                Section::make('Timestamps')
                    ->icon('heroicon-o-clock')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-')
                            ->icon('heroicon-o-calendar-days'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-')
                            ->icon('heroicon-o-pencil-square'),
                    ]),
            ]);
    }
}
