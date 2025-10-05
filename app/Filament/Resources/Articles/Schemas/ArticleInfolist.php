<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Article Overview')
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        ImageEntry::make('image')
                            ->label('Featured Image')
                            ->disk('public')
                            ->imageWidth(480)
                            ->imageHeight(240)
                            ->alignCenter()
                            ->columnSpanFull()
                            ->getStateUsing(fn($record) => $record->image
                                ? asset("storage/{$record->image}")
                                : asset('assets/default-img.jpg')),
                        TextEntry::make('content')
                            ->placeholder('-')
                            ->columnSpanFull()->html(),
                    ]),
                Section::make('Details')
                    ->icon('heroicon-o-information-circle')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('category')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'published' => 'success',
                                'draft' => 'gray',
                                default => 'warning',
                            }),
                        TextEntry::make('published_at')
                            ->dateTime()
                            ->placeholder('-')
                            ->icon('heroicon-o-calendar-days')
                            ->columnSpanFull(),
                    ]),

                Section::make('Author Information')
                    ->icon('heroicon-o-user-circle')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('author.name')
                            ->label('Author')
                            ->placeholder('-')
                            ->icon('heroicon-o-user'),
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
