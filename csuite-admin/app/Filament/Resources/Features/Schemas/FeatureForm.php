<?php

namespace App\Filament\Resources\Features\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('card_id')
                    ->required()
                    ->numeric(),
                TextInput::make('feature_icon')
                    ->required(),
                TextInput::make('feature_heading')
                    ->required(),
                Textarea::make('feature_paragraph')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
