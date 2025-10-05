<?php

namespace App\Filament\Resources\Solutions\Pages;

use App\Filament\Resources\Solutions\SolutionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSolutions extends ListRecords
{
    protected static string $resource = SolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Solutions'),
            'service' => Tab::make('Services')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'service')),
            'infrastructure' => Tab::make('Infrastructures')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'infrastructure')),
            'product' => Tab::make('Products')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('category', 'product')),
            'published' => Tab::make('Published')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'published')),
            'archived' => Tab::make('Archived')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'archived')),
            'draft' => Tab::make('Draft')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'draft')),
        ];
    }
}
