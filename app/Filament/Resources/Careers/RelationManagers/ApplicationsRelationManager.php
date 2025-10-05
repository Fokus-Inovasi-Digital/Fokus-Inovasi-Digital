<?php

namespace App\Filament\Resources\Careers\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';
    protected static ?string $title = 'Applicants';
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                TextColumn::make('full_name'),
                TextColumn::make('email')
                    ->copyable()
                    ->icon('heroicon-o-envelope'),
                TextColumn::make('phone')
                    ->copyable()
                    ->icon('heroicon-o-phone'),
                TextColumn::make('status')
                    ->badge()->sortable()
                    ->formatStateUsing(fn(string $state) => ucfirst($state))
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'reviewed' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('cv_file')
                    ->label('CV')
                    ->badge()->alignCenter()
                    ->color('info')
                    ->url(fn($record): ?string => $record->cv_file ? Storage::url($record->cv_file) : null, true)
                    ->formatStateUsing(fn($state) => $state ? 'View' : '-')
                    ->icon('heroicon-o-document-arrow-down'),
                TextColumn::make('cover_letter_file')
                    ->label('Cover Letter')
                    ->badge()->alignCenter()
                    ->color('info')
                    ->url(fn($record): ?string => $record->cover_letter_file ? Storage::url($record->cover_letter_file) : null, true)
                    ->formatStateUsing(fn($state) => $state ? 'View' : '-')
                    ->icon('heroicon-o-document-arrow-down'),
                TextColumn::make('portfolio_file')
                    ->label('Portfolio')
                    ->badge()->alignCenter()
                    ->color('info')
                    ->url(fn($record): ?string => $record->cover_letter_file ? Storage::url($record->cover_letter_file) : null, true)
                    ->formatStateUsing(fn($state) => $state ? 'View' : '-')
                    ->icon('heroicon-o-document-arrow-down'),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->schema([
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
                        TextEntry::make('address')
                            ->label('Address')
                            ->columnSpanFull(),
                        TextEntry::make('additional_notes')
                            ->label('Applicant Additional Notes')
                            ->columnSpanFull(),
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
                    ]),
                    Action::make('mark_as_reviewed')
                        ->label('Mark as Reviewed')
                        ->action(function ($record) {
                            $record->update(['status' => 'reviewed']);
                        })
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->visible(fn($record) => $record->status === 'pending'),
                ])
            ]);
    }
}