<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
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
                        TextEntry::make('title')
                            ->label('Title'),
                        TextEntry::make('slug')
                            ->label('Slug'),
                        ImageEntry::make('image')
                            ->label('Featured Image')
                            ->disk('public')
                            // ->imageSize(120)
                            ->imageWidth(480)
                            ->imageHeight(240)
                            ->alignCenter()
                            ->columnSpanFull()
                            ->getStateUsing(fn($record) => $record->image
                                ? asset("storage/{$record->image}")
                                : asset('assets/default-articles.jpg')),
                        TextEntry::make('content')
                            ->label('Content')
                            ->placeholder('-')
                            ->columnSpanFull()->html(),
                    ]),
                // Section::make('Gallery')
                //     ->icon('heroicon-o-photo')
                //     ->columns(3)
                //     ->schema([
                //         RepeatableEntry::make('gallery')
                //             ->label('Gallery Images')
                //             ->schema([
                //                 ImageEntry::make('image')
                //                     ->label('')
                //                     ->disk('public')
                //                     ->imageSize(100)
                //                     ->getStateUsing(fn($state) => asset('storage/articles/gallery/' . $state)),
                //             ])
                //             ->getStateUsing(fn($record) => collect($record->gallery)->map(fn($img) => ['image' => $img])->toArray())
                //             ->visible(fn($record) => is_array($record->gallery) && count($record->gallery) > 0)
                //             ->columnSpanFull(),
                //     ]),

                Section::make('Details')
                    ->icon('heroicon-o-information-circle')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('category')
                            ->label('Category')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'published' => 'success',
                                'draft' => 'gray',
                                default => 'warning',
                            }),
                        TextEntry::make('published_at')
                            ->label('Published At')
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
                            ->label('Created At')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
