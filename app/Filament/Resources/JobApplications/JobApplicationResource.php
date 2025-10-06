<?php

namespace App\Filament\Resources\JobApplications;

use App\Filament\Resources\JobApplications\Pages\ListJobApplications;
use App\Filament\Resources\JobApplications\Pages\ViewJobApplication;
use App\Filament\Resources\JobApplications\Schemas\JobApplicationInfolist;
use App\Filament\Resources\JobApplications\Tables\JobApplicationsTable;
use App\Models\JobApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;
    protected static ?string $recordTitleAttribute = 'full_name';
    protected static string|\UnitEnum|null $navigationGroup = 'HR & Careers';
    protected static ?string $label = 'Applicants';
    public static function getNavigationSort(): ?int
    {
        return 5;
    }
    public static function getNavigationBadge(): ?string
    {
        $newMessagesCount = JobApplication::where('status', 'pending')->count();
        return $newMessagesCount > 0 ? (string) $newMessagesCount : null;
    }
    public static function getNavigationBadgeColor(): string|array|null
    {
        $newMessagesCount = JobApplication::where('status', 'pending')->count();
        return $newMessagesCount > 5 ? 'warning' : 'primary';
    }
    public static function infolist(Schema $schema): Schema
    {
        return JobApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobApplicationsTable::configure($table);
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
            'index' => ListJobApplications::route('/'),
        ];
    }
}
