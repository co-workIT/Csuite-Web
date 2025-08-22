<?php

namespace App\Filament\Resources\ProductCards\Pages;

use App\Filament\Resources\ProductCards\ProductCardResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCard extends CreateRecord
{
    protected static string $resource = ProductCardResource::class;
}
