<?php

namespace App\Filament\Resources\CompanyProfiles;

use App\Filament\Resources\CompanyProfiles\Pages\CreateCompanyProfile;
use App\Filament\Resources\CompanyProfiles\Pages\EditCompanyProfile;
use App\Filament\Resources\CompanyProfiles\Pages\ListCompanyProfiles;
use App\Filament\Resources\CompanyProfiles\Pages\ViewCompanyProfile;
use App\Filament\Resources\CompanyProfiles\Schemas\CompanyProfileForm;
use App\Filament\Resources\CompanyProfiles\Schemas\CompanyProfileInfolist;
use App\Filament\Resources\CompanyProfiles\Tables\CompanyProfilesTable;
use App\Models\CompanyProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyProfileResource extends Resource
{
    protected static ?string $model = CompanyProfile::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;
    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return CompanyProfileForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanyProfileInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanyProfilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompanyProfiles::route('/'),
            'create' => CreateCompanyProfile::route('/create'),
            'view' => ViewCompanyProfile::route('/{record}'),
            'edit' => EditCompanyProfile::route('/{record}/edit'),
        ];
    }
}
