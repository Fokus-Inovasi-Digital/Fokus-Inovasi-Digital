<?php

namespace App\Filament\Resources\JobApplications\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class JobApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Name')
                    ->searchable(),
                TextColumn::make('career.title')->label('Apply for')
                    ->searchable(),
                TextColumn::make('full_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email')
                    ->label('Email address')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('cv_file')
                    ->label('CV')
                    ->formatStateUsing(fn($state) => $state ? 'CV' : '-')
                    ->url(fn($record) => $record->cv_file ? Storage::url($record->cv_file) : null, true),
                TextColumn::make('cover_letter_file')
                    ->label('Cover Letter')
                    ->formatStateUsing(fn($state) => $state ? 'Cover Letter' : '-')
                    ->url(fn($record) => $record->cover_letter_file ? Storage::url($record->cover_letter_file) : null, true),
                TextColumn::make('portfolio_file')
                    ->label('Portfolio')
                    ->formatStateUsing(fn($state) => $state ? 'Portfolio' : '-')
                    ->url(fn($record) => $record->portfolio_file ? Storage::url($record->portfolio_file) : null, true),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        $colors = [
                            'pending' => '#facc15',
                            'reviewed' => '#4ade80',
                        ];

                        $color = $colors[$state] ?? '#d1d5db';

                        return new HtmlString("
                        <span style='
                            display: inline-block;
                            background-color: {$color};
                            color: #1f2937;
                            padding: 0.3em 0.75em;
                            border-radius: 0.5em;
                            font-size: 0.9em;
                            font-weight: 600;
                            text-transform: capitalize;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                            transform: scale(0.95);
                            animation: popIn 0.4s ease-out forwards;
                        '>
                            {$state}
                        </span>
                
                        <style>
                            @keyframes popIn {
                                from {
                                    opacity: 0;
                                    transform: scale(0.8);
                                }
                                to {
                                    opacity: 1;
                                    transform: scale(1);
                                }
                            }
                        </style>
                    ");
                    }),
                TextColumn::make('created_at')
                    ->dateTime('F d, Y')
                    ->sortable()
                    ->label('Apply Date'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('career.title')
                    ->relationship('career', 'title')
                    ->label('Career')
                    ->placeholder('Job Title')
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->icon('heroicon-o-eye'),
                    Action::make('mark_as_reviewed')
                        ->label('Mark as Reviewed')
                        ->action(function ($record) {
                            $record->update(['status' => 'reviewed']);
                        })
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->visible(fn($record) => $record->status === 'pending'),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
