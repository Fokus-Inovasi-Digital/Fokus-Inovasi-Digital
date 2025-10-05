<?php

namespace App\Filament\Resources\Careers\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CareersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()->limit(30),
                TextColumn::make('location')
                    ->searchable()->limit(20),
                TextColumn::make('status')
                    ->badge()->alignCenter()
                    ->color(fn($state) => match ($state) { 'published' => 'success', 'draft' => 'gray', default => 'warning', }),
                TextColumn::make('work_type')
                    ->badge()->alignCenter()
                    ->color(fn($state) => match ($state) { 'remote' => 'info', 'hybrid' => 'gray', default => 'warning', }),
                TextColumn::make('applicants_count')
                    ->label('Applicants')->alignCenter()
                    ->tooltip('Number of applicants for this career')
                    ->getStateUsing(fn($record) => $record->Applications()->count()),
                TextColumn::make('createdBy.name')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime('F d, Y')->sortable(),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
                SelectFilter::make('work_type')
                    ->options([
                        'onsite' => 'Onsite',
                        'remote' => 'Remote',
                        'hybrid' => 'Hybrid',
                    ])
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
