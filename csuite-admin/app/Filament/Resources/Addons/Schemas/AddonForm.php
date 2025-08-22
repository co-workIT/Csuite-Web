<?php

namespace App\Filament\Resources\Addons\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;


class AddonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('category')
                //     ->required()
                //     ->numeric(),
                Select::make('category')
                    ->relationship('category', 'category_name')
                    ->label('Category')
                    ->required(),
                TextInput::make('name')
                    ->default(null),
                TextInput::make('icon')
                    ->default(null),
                TextInput::make('short_detail')
                    ->default(null),
            ]);
    }
}
