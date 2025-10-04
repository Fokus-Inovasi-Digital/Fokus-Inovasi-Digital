<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Articles'),
            'article' => Tab::make('Articles')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'article')),
            'csr' => Tab::make('CSR')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'csr')),
            'activity' => Tab::make('Activity')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'activity')),
            'published' => Tab::make('Published')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'published')),
            'archived' => Tab::make('Archived')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'archived')),
            'draft' => Tab::make('Draft')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'draft')),
        ];
    }
}
