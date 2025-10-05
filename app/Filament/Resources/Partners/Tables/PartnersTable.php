<?php

namespace App\Filament\Resources\Partners\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PartnersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                ImageColumn::make('logo')
                    ->square()
                    ->imageWidth(90)
                    ->imageHeight(45)
                    ->getStateUsing(function ($record) {
                        if ($record->logo) {
                            return asset("storage/{$record->logo}");
                        }
                        return asset('assets/default-img.jpg');
                    })
                    ->extraImgAttributes(['title' => 'Partners Logo', 'loading' => 'lazy', 'style' => 'border-radius: 0.375rem; object-fit: cover;']),
                TextColumn::make('website_url')
                    ->label('Website')
                    ->getStateUsing(fn($record) => $record->website_url
                        ? "<a href='{$record->website_url}' target='_blank' class='truncate' title='{$record->website_url}'>{$record->website_url}</a>"
                        : 'No URL')
                    ->html()
                    ->limit(30)
                    ->extraAttributes(['class' => 'py-2 px-4 rounded-lg border-2 border-gray-300 w-48 truncate']),
                TextColumn::make('createdBy.name')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime('F d, Y')->sortable(),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
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
