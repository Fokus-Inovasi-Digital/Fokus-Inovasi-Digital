<?php

namespace App\Filament\Resources\CompanyProfiles\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompanyProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Company Logo')->alignCenter()
                    ->circular()->imageSize(50)
                    ->getStateUsing(function ($record) {
                        if ($record->logo) {
                            return asset("storage/{$record->logo}");
                        }
                        return asset('assets/default-img.jpg');
                    }),
                TextColumn::make('company_name')
                    ->label('Company Name')
                    ->icon('heroicon-o-building-office'),
                TextColumn::make('hero_subheading')->label('Description')
                    ->limit(23)->icon('heroicon-o-document-text'),
                TextColumn::make('phone')
                    ->icon('heroicon-o-phone'),
                TextColumn::make('email')
                    ->label('Email address')
                    ->icon('heroicon-o-envelope'),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                ])
            ])
            ->paginated(false);
    }
}
