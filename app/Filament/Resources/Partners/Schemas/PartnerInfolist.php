<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Partner Overview')
                    ->icon('heroicon-o-building-office')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Partner Name')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                Section::make('Partner Details')
                    ->icon('heroicon-o-information-circle')
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('logo')
                            ->label('Logo')
                            ->disk('public')
                            ->imageWidth(240)
                            ->imageHeight(120)
                            ->alignCenter()
                            ->columnSpanFull()
                            ->getStateUsing(fn($record) => $record->logo
                                ? asset("storage/{$record->logo}")
                                : asset('assets/default-img.jpg'))
                            ->extraImgAttributes(['title' => 'Partner Logo', 'loading' => 'lazy', 'style' => 'border-radius: 0.375rem; object-fit: cover;']),
                    ]),

                Section::make('Partner Website')
                    ->icon('heroicon-o-link')
                    ->columns(1)
                    ->schema([
                        TextEntry::make('website_url')
                            ->label('Website')
                            ->getStateUsing(fn($record) => $record->website_url
                                ? "<a href='{$record->website_url}' target='_blank' class='text-blue-500 hover:underline'>{$record->website_url}</a>"
                                : 'No URL')
                            ->html()
                            ->columnSpanFull(),
                    ]),

                Section::make('Author Information')
                    ->icon('heroicon-o-user-circle')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('createdBy.name')
                            ->label('Created By')
                            ->placeholder('-')
                            ->icon('heroicon-o-user-circle'),
                        TextEntry::make('updatedBy.name')
                            ->label('Updated By')
                            ->placeholder('-')
                            ->icon('heroicon-o-pencil-square'),
                    ]),

                Section::make('Timestamps')
                    ->icon('heroicon-o-clock')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')->label('Created At')->dateTime()->placeholder('-')->icon('heroicon-o-calendar-days'),
                        TextEntry::make('updated_at')->label('Updated At')->dateTime()->placeholder('-')->icon('heroicon-o-pencil-square'),
                    ]),
            ]);
    }
}
