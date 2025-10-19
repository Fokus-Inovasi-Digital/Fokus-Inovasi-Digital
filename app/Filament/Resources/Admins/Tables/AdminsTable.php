<?php

namespace App\Filament\Resources\Admins\Tables;

use App\Models\User;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class AdminsTable
{
    public static function configure(Table $table): Table
    {
        $protectedAdminId = 1;
        return $table
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('created_at')->dateTime('F d, Y')->sortable(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make()
                        ->hidden(fn(User $record): bool => $record->id === $protectedAdminId),
                    DeleteAction::make()
                        ->hidden(fn(User $record): bool => $record->id === $protectedAdminId),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->label('Delete selected')
                        ->icon('heroicon-s-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) use ($protectedAdminId) {
                            $deletedCount = 0;
                            $protectedFound = false;

                            foreach ($records as $record) {
                                if ($record->id === $protectedAdminId) {
                                    $protectedFound = true;
                                    continue;
                                }

                                $record->delete();
                                $deletedCount++;
                            }

                            if ($protectedFound && $deletedCount > 0) {
                                Notification::make()
                                    ->title('Action Partially Completed')
                                    ->body("Deleted {$deletedCount} admin(s). The primary admin (ID: {$protectedAdminId}) cannot be deleted.")
                                    ->status('warning')
                                    ->send();
                            } elseif ($protectedFound && $deletedCount === 0) {
                                Notification::make()
                                    ->title('Action Cancelled')
                                    ->body("The primary admin (ID: {$protectedAdminId}) cannot be deleted.")
                                    ->status('warning')
                                    ->send();
                            } elseif (!$protectedFound && $deletedCount > 0) {
                                Notification::make()
                                    ->title('Admins Deleted Successfully')
                                    ->body("{$deletedCount} admin(s) have been removed.")
                                    ->status('success')
                                    ->send();
                            }
                        }),
                ]),
            ]);
    }
}
