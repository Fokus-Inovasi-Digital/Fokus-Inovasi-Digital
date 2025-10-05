<?php

namespace App\Filament\Resources\Feedback\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FeedbackInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Feedback Information')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('User')
                            ->icon('heroicon-o-user')
                            ->placeholder('N/A'),
                        TextEntry::make('subject')
                            ->placeholder('N/A')
                            ->icon('heroicon-o-chat-bubble-left-ellipsis'),
                    ]),
                Section::make('Message Details')
                    ->icon('heroicon-o-document-text')
                    ->columns(1)
                    ->schema([
                        TextEntry::make('message')
                            ->label('Message')
                            ->columnSpanFull()
                            ->placeholder('N/A')
                            ->icon('heroicon-o-pencil')
                    ]),
                Section::make('Status & Type')
                    ->icon('heroicon-o-information-circle')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('type')
                            ->label('Feedback Type')
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-o-cog')
                            ->placeholder('N/A'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn($state) => match ($state) {
                                'new' => 'primary',
                                default => 'gray',
                            })
                            ->icon('heroicon-o-check-circle')
                            ->placeholder('N/A'),
                    ]),
                Section::make('Timestamps')
                    ->icon('heroicon-o-clock')
                    ->columns(2)
                    ->schema([
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
                    ])->collapsed(),
            ]);
    }
}
