<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Partner Name')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull()
                    ->rows(3),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->directory('company-logo')
                    ->disk('public')
                    ->maxSize(5 * 1024)
                    ->imageResizeMode('contain')
                    ->columnSpanFull()
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('partner-logo-'),
                    ),
                TextInput::make('website_url')->label('Website URL')->url()->placeholder('Enter the website URL')->columnSpanFull(),
                Hidden::make('created_by')->dehydrated()->default(fn() => auth()->id()),
                Hidden::make('updated_by')->dehydrated()->default(fn() => auth()->id()),
            ]);
    }
}
