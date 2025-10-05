<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->limit(20),
                TextColumn::make('company')
                    ->searchable()
                    ->limit(33),
                TextColumn::make('subject')
                    ->limit(33)
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()->color(fn($state) => match ($state) {
                        'new' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->dateTime('F d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip('The date when the message was created'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->placeholder('All')
                    ->options([
                        'new' => 'New',
                        'reviewed' => 'Reviewed',
                    ]),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->icon('heroicon-o-eye'),
                    Action::make('status')
                        ->label('Mark as Reviewed')
                        ->action(function ($record) {
                            $record->update(['status' => 'reviewed']);
                        })
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->visible(fn($record) => $record->status === 'new'),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
        // ->description('Manage and review the contact messages sent by users.');
    }
}
