<?php

namespace App\Filament\Resources\CompanyProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CompanyProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('logo')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('company-logo')
                    ->label('Company Logo')
                    ->columnSpanFull()
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('company-logo-'),
                    ),
                TextInput::make('company_name')
                    ->required()
                    ->default('PT Fokus Inovasi Digital'),
                TextInput::make('hero_subheading'),
                Textarea::make('about_subheading')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Description (About us)')
                    ->columnSpanFull()->rows(5),
                Textarea::make('vision')
                    ->columnSpanFull()->rows(7),
                Textarea::make('mission')
                    ->columnSpanFull()->rows(7),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->tel()->numeric(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('quote'),
                TextInput::make('website_url')->url(),
                Repeater::make('social_media')
                    ->schema([
                        Select::make('platform')
                            ->label('Social Media Platform')
                            ->options([
                                'facebook' => 'Facebook',
                                'twitter' => 'Twitter',
                                'instagram' => 'Instagram',
                                'linkedin' => 'LinkedIn',
                                'youtube' => 'YouTube',
                                'tiktok' => 'TikTok',
                                'github' => 'GitHub',
                            ])
                            ->required(),
                        TextInput::make('url')
                            ->label('URL')
                            ->url()
                            ->required(),
                    ])
                    ->label('Social Media Links')
                    ->maxItems(3)
                    ->columnSpanFull(),
            ]);
    }
}
