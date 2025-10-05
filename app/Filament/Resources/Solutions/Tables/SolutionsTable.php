<?php

namespace App\Filament\Resources\Solutions\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SolutionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category')
                    ->badge()->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('title')
                    ->searchable()->limit(30),
                TextColumn::make('short_description')
                    ->limit(35),
                TextColumn::make('slug')->badge()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')->badge()->sortable()->color(fn(string $state): string => match ($state) {
                    'published' => 'success',
                    'draft' => 'gray',
                    default => 'warning',
                }),
                TextColumn::make('published_at')->dateTime('F d, Y h:i A')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('createdBy.name')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
