<?php

namespace App\Filament\Resources\Solutions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SolutionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1) // Gunakan satu kolom untuk menampilkan info
            ->components([
                Section::make('Solution Overview') // Bagian pertama untuk overview
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Title'),
                        TextEntry::make('slug')
                            ->label('Slug')->badge(),
                        TextEntry::make('short_description')
                            ->label('Short Description')
                            ->columnSpanFull(),
                    ]),

                Section::make('Solution Content') // Konten solusi
                    ->icon('heroicon-o-pencil-square')
                    ->columns(1)
                    ->schema([
                        TextEntry::make('content')
                            ->label('Content')
                            ->columnSpanFull()
                            ->html()
                            ->placeholder('-'),
                    ]),

                Section::make('Solution Details') // Menampilkan status dan kategori solusi
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
                        TextEntry::make('createdBy.name')
                            ->label('Created By')
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
                            ->placeholder('-')
                            ->icon('heroicon-o-calendar-days'),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime()
                            ->placeholder('-')
                            ->icon('heroicon-o-pencil-square')
                    ]),
            ]);
    }
}
