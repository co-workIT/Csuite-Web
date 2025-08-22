<?php

namespace App\Filament\Resources\ProductCards\Pages;

use App\Filament\Resources\ProductCards\ProductCardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductCards extends ListRecords
{
    protected static string $resource = ProductCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
