<?php

namespace App\Filament\Resources\ProductCards\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductCardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                TextInput::make('heading')
                    ->required(),
                TextInput::make('paragraph')
                    ->required(),
                TextInput::make('icon')
                    ->required(),
            ]);
    }
}
