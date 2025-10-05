<?php

namespace App\Filament\Resources\Careers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CareerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Career Overview')
                    ->icon('heroicon-o-briefcase')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Job Title'),
                        TextEntry::make('slug')->badge(),
                        TextEntry::make('location'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'published' => 'success',
                                'draft' => 'gray',
                                default => 'warning',
                            }),
                        TextEntry::make('work_type')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'remote' => 'info',
                                'onsite' => 'success',
                                'hybrid' => 'warning',
                                default => 'default',
                            }),
                        TextEntry::make('applications_count')
                            ->label('Total Applicants')
                            ->counts('applications')
                            ->badge()
                            ->icon('heroicon-o-users')
                            ->color('primary'),
                    ]),
                Section::make('Job Description')
                    ->icon('heroicon-o-document-text')
                    ->columns(1)
                    ->schema([
                        TextEntry::make('description')
                            ->columnSpanFull()
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
                Section::make('User Information')
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
            ]);
    }
}
