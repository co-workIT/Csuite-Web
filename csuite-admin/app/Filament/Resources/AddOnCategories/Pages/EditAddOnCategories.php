<?php

namespace App\Filament\Resources\AddOnCategories\Pages;

use App\Filament\Resources\AddOnCategories\AddOnCategoriesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAddOnCategories extends EditRecord
{
    protected static string $resource = AddOnCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
