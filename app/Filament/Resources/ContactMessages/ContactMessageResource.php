<?php

namespace App\Filament\Resources\ContactMessages;

use App\Filament\Resources\ContactMessages\Pages\ListContactMessages;
use App\Filament\Resources\ContactMessages\Schemas\ContactMessageInfolist;
use App\Filament\Resources\ContactMessages\Tables\ContactMessagesTable;
use App\Models\ContactMessage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;
    protected static string|\UnitEnum|null $navigationGroup = 'Inquiries';
    public static function getNavigationSort(): ?int
    {
        return 6;
    }
    public static function getNavigationBadge(): ?string
    {
        $newMessagesCount = ContactMessage::where('status', 'new')->count();
        return $newMessagesCount > 0 ? (string) $newMessagesCount : null;
    }
    public static function getNavigationBadgeColor(): string|array|null
    {
        $newMessagesCount = ContactMessage::where('status', 'new')->count();
        return $newMessagesCount > 5 ? 'warning' : 'primary';
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactMessageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactMessagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactMessages::route('/'),
        ];
    }
}
