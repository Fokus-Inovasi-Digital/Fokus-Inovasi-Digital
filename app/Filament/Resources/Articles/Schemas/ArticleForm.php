<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $slug = Str::slug($state);
                        $existingSlug = Article::where('slug', $slug)->first();
                        if ($existingSlug) {
                            $slug = $slug . '-' . uniqid();
                        }
                        $set('slug', $slug);
                    }),

                TextInput::make('slug')
                    ->hint('Generated from the title automatically.')
                    ->required()->readOnly()->disabled()->dehydrated(true),

                FileUpload::make('image')
                    ->label('Featured Image')
                    ->image()
                    ->directory('articles')
                    ->disk('public')
                    ->maxSize(5 * 1024)
                    ->imageResizeMode('cover')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->extraInputAttributes([
                        'style' => 'min-height: 200px; max-height: 500px; overflow-y: auto;',
                    ]),
                Select::make('category')->options([
                    'article' => 'Article',
                    'activity' => 'Activity',
                    'csr' => 'CSR',
                ])->default('article')->required(),
                Select::make('status')->options([
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
                DateTimePicker::make('published_at')->disabled()->readOnly()->dehydrated(true),
                Hidden::make('author_id')->dehydrated()->default(fn() => auth()->id()),
            ]);
    }
}
