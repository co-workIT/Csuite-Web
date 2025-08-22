<?php

namespace App\Filament\Resources\PricingFeatures\Pages;

use App\Filament\Resources\PricingFeatures\PricingFeatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePricingFeatures extends ManageRecords
{
    protected static string $resource = PricingFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
