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
                ImageColumn::make('profile_picture')
                    ->label('Company Logo')->alignCenter()
                    ->circular()->imageSize(50)
                    ->getStateUsing(function ($record) {
                        if ($record->profile_picture) {
                            return asset('storage/logo/' . $record->profile_picture);
                        }
                        return 'https://media.licdn.com/dms/image/v2/D4D0BAQHsagCK6zI12w/company-logo_200_200/B4DZkqUvXlIcAI-/0/1757351704830/fokus_id_logo?e=2147483647&v=beta&t=p3Gmk1OmuQFZYMJhPlZWMdhtPHhAGTtYaNSTdLYb7P0';
                        // return asset('storage/logo/logo.png');
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
