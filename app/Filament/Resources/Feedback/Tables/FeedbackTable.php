<?php

namespace App\Filament\Resources\Feedback\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class FeedbackTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User Name')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user'),
                TextColumn::make('subject')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-chat-bubble-bottom-center'),
                TextColumn::make('type')
                    ->label('Feedback Type')->alignCenter()
                    ->formatStateUsing(function ($state) {
                        $colors = [
                            'bug' => '#f87171',
                            'feature_request' => '#60a5fa',
                            'improvement' => '#34d399',
                            'compliment' => '#fbbf24',
                            'complaint' => '#f97316',
                            'other' => '#a1a1aa',
                        ];

                        $color = $colors[$state] ?? '#d1d5db';

                        return new HtmlString("
                        <span style='
                            display: inline-block;
                            background-color: {$color};
                            color: #1f2937;
                            padding: 0.3em 0.75em;
                            border-radius: 1em;
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
                TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'new' => 'primary',
                        'closed' => 'gray',
                        default => 'gray',
                    })
                    ->icon('heroicon-o-check-circle'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'bug' => 'Bug',
                        'feature_request' => 'Feature Request',
                        'improvement' => 'Improvement',
                        'compliment' => 'Compliment',
                        'complaint' => 'Complaint',
                        'other' => 'Other',
                    ])->placeholder('All Types')
                    ->label('Feedback Type'),
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'closed' => 'Closed',
                    ])->placeholder('All'),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->icon('heroicon-o-eye'),
                    Action::make('mark_as_closed')
                        ->label('Mark as Closed')
                        ->action(function ($record) {
                            $record->update(['status' => 'closed']);
                        })
                        ->color('info')
                        ->icon('heroicon-o-check-circle')
                        ->visible(fn($record) => $record->status === 'new')
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                ]),
            ]);
    }
}
