<?php

namespace App\Filament\Resources\ProductCards\Pages;

use App\Filament\Resources\ProductCards\ProductCardResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductCard extends EditRecord
{
    protected static string $resource = ProductCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
