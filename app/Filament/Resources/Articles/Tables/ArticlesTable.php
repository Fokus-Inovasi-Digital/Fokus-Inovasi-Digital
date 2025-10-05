<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->square()
                    ->imageWidth(90)
                    ->imageHeight(45)
                    ->getStateUsing(function ($record) {
                        if ($record->image) {
                            return asset("storage/{$record->image}");
                        }
                        return asset('assets/default-img.jpg');
                    })
                    ->extraImgAttributes(['title' => 'Articles Image', 'loading' => 'lazy', 'style' => 'border-radius: 0.375rem; object-fit: cover;']),
                TextColumn::make('category')->badge()->default('-')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')->limit(33)->searchable(),
                TextColumn::make('slug')->badge()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')->badge()->sortable()->color(fn(string $state): string => match ($state) {
                    'published' => 'success',
                    'draft' => 'gray',
                    default => 'warning',
                }),
                TextColumn::make('published_at')->dateTime('F d, Y h:i A')->sortable(),
                TextColumn::make('author.name')->searchable()->toggleable(isToggledHiddenByDefault: true),
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
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
