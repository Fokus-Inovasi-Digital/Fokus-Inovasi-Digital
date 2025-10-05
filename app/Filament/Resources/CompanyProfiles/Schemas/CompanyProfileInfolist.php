<?php

namespace App\Filament\Resources\CompanyProfiles\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CompanyProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('General Information')
                    ->columns(1)
                    ->icon('heroicon-o-building-office-2')
                    ->schema([
                        ImageEntry::make('logo')
                            ->label('Company Logo')
                            ->imageSize(150)
                            ->disk('public')
                            ->circular()
                            ->alignCenter()
                            ->getStateUsing(fn($record) => $record->logo
                                ? asset("storage/{$record->logo}")
                                : asset('assets/default-img.jpg'))
                            ->extraImgAttributes(['title' => 'Company Logo', 'loading' => 'lazy', 'style' => 'border-radius: 0.375rem; object-fit: cover;']),
                        TextEntry::make('company_name')
                            ->label('Company Name'),
                    ]),
                Section::make('Description & Strategy')
                    ->columns(1)
                    ->icon('heroicon-o-book-open')
                    ->schema([
                        TextEntry::make('hero_subheading')
                            ->label('Hero Subheading')
                            ->placeholder('-'),
                        TextEntry::make('about_subheading')
                            ->label('About Subheading')
                            ->placeholder('-'),
                        TextEntry::make('description')
                            ->label('Description (About Us)')
                            ->placeholder('-'),
                        TextEntry::make('vision')
                            ->label('Vision')
                            ->placeholder('-'),
                        TextEntry::make('mission')
                            ->label('Mission')
                            ->placeholder('-'),
                        TextEntry::make('quote')
                            ->placeholder('-')
                            ->label('Quote')
                            ->badge(),
                    ]),
                Section::make('Contact & Social Media')
                    ->columns(1)
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        TextEntry::make('address')
                            ->label('Office Address')
                            ->placeholder('-')
                            ->icon('heroicon-o-map-pin'),
                        TextEntry::make('phone')
                            ->label('Phone Number')
                            ->placeholder('-')
                            ->icon('heroicon-o-phone'),
                        TextEntry::make('email')
                            ->label('Email Address')
                            ->placeholder('-')
                            ->icon('heroicon-o-envelope'),
                        TextEntry::make('website_url')
                            ->label('Website URL')
                            ->placeholder('-')
                            ->icon('heroicon-o-link')
                            ->url(fn($state) => filled($state) ? $state : null)
                            ->openUrlInNewTab(),
                        RepeatableEntry::make('social_media')
                            ->label('Social Media Links')
                            ->schema([
                                TextEntry::make('platform')
                                    ->badge()
                                    ->color('primary'),
                                TextEntry::make('url')
                                    ->icon('heroicon-o-arrow-top-right-on-square')
                                    ->url(fn($state) => $state)
                                    ->openUrlInNewTab(),
                            ])
                            ->grid(3)
                            ->placeholder('none'),
                    ]),
                Section::make('Metadata')
                    ->columns(1)
                    ->icon('heroicon-o-clock')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime(),
                    ]),
            ]);
    }
}
