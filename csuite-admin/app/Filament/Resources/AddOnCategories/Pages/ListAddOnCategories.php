<?php

namespace App\Filament\Resources\AddOnCategories\Pages;

use App\Filament\Resources\AddOnCategories\AddOnCategoriesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAddOnCategories extends ListRecords
{
    protected static string $resource = AddOnCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
