<?php

namespace App\Filament\Resources\JobApplications\Schemas;

use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JobApplicationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Applicant Information')
                    ->icon('heroicon-o-user')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('full_name')
                            ->label('Full Name')
                            ->weight('bold'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->icon('heroicon-o-envelope')
                            ->copyable()
                            ->color('primary'),
                        TextEntry::make('phone')
                            ->label('Phone Number')
                            ->icon('heroicon-o-phone')
                            ->copyable(),
                    ]),
                Section::make('Application Details')
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('career.title')
                            ->label('Applied Job Position')
                            ->badge(),
                        TextEntry::make('status')
                            ->badge()
                            ->colors([
                                'primary' => 'pending',
                                'success' => 'reviewed',
                            ]),
                    ]),
                Section::make('Additional Information')
                    ->icon('heroicon-o-information-circle')
                    ->columns(1)
                    ->schema([
                        TextEntry::make('address')
                            ->columnSpanFull(),
                        TextEntry::make('additional_notes')
                            ->label('Applicant Additional Notes')
                            ->columnSpanFull(),
                    ]),
                Fieldset::make('Application Documents')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Actions::make([
                                    Action::make('cv_file')
                                        ->label('CV')
                                        ->icon('heroicon-o-arrow-down-tray')
                                        ->openUrlInNewTab()
                                        ->url(fn($record) => asset("storage/{$record->cv_file}"))
                                ]),
                                Actions::make([
                                    Action::make('cover_letter_file')
                                        ->label('Cover Letter')
                                        ->icon('heroicon-o-arrow-down-tray')
                                        ->url(fn($record) => asset("storage/{$record->cover_letter_file}"))
                                        ->openUrlInNewTab()
                                        ->hidden(fn($record) => is_null($record->cover_letter_file)),
                                ]),
                                Actions::make([
                                    Action::make('portfolio_file')
                                        ->label('Portfolio')
                                        ->icon('heroicon-o-arrow-down-tray')
                                        ->url(fn($record) => asset("storage/{$record->portfolio_file}"))
                                        ->openUrlInNewTab()
                                        ->hidden(fn($record) => is_null($record->portfolio_file))
                                ]),
                            ])
                            ->columnSpanFull()
                            ->inlineLabel()
                    ]),
                Section::make('Timestamps')
                    ->icon('heroicon-o-clock')
                    ->columns(2)
                    ->compact()
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->dateTime(),
                    ])->collapsed(),
            ]);
    }
}
