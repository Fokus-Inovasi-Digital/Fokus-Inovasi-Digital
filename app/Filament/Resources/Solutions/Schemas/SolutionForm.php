<?php

namespace App\Filament\Resources\Solutions\Schemas;

use App\Models\Solution;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Str;

class SolutionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $slug = Str::slug($state);

                        $existingSlug = Solution::where('slug', $slug)->first();

                        if ($existingSlug) {
                            $slug = $slug . '-' . uniqid();
                        }

                        $set('slug', $slug);
                    }),

                TextInput::make('slug')
                    ->label('Slug')
                    ->hint('Generated from the title automatically.')
                    ->required()->readOnly()->disabled()->dehydrated(true),
                Textarea::make('short_description')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Content')
                    ->required()
                    ->columnSpanFull()
                    ->extraInputAttributes([
                        'style' => 'min-height: 200px; max-height: 500px; overflow-y: auto;',
                    ]),
                Select::make('category')->label('Category')->options([
                    'service' => 'Service',
                    'infrastructure' => 'Infrastructure',
                    'product' => 'Product',
                ])->default('service')->required(),
                Select::make('status')->label('Status')->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                    'archived' => 'Archived',
                ])->default('draft')->reactive()->afterStateUpdated(function (Set $set, $state) {
                    if ($state === 'published') {
                        $set('published_at', now());
                    } else {
                        $set('published_at', null);
                    }
                }),
                DateTimePicker::make('published_at')->label('Published At')->disabled()->readOnly()->dehydrated(true),

                Hidden::make('created_by')
                    ->dehydrated()
                    ->default(fn() => auth()->id()),
                Hidden::make('updated_by')
                    ->dehydrated()
                    ->default(fn() => auth()->id())
            ]);
    }
}
