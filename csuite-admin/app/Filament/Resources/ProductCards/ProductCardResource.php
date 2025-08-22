<?php

namespace App\Filament\Resources\ProductCards;

use App\Filament\Resources\ProductCards\Pages\CreateProductCard;
use App\Filament\Resources\ProductCards\Pages\EditProductCard;
use App\Filament\Resources\ProductCards\Pages\ListProductCards;
use App\Filament\Resources\ProductCards\Schemas\ProductCardForm;
use App\Filament\Resources\ProductCards\Tables\ProductCardsTable;
use App\Filament\Resources\ProductCardResource\RelationManagers\FeaturesRelationManager;
use App\Models\ProductCard;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;


class ProductCardResource extends Resource
{
    protected static ?string $model = ProductCard::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProductCardForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductCardsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
            // RelationManagers\FeaturesRelationManager::class,
            FeaturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductCards::route('/'),
            'create' => CreateProductCard::route('/create'),
            'edit' => EditProductCard::route('/{record}/edit'),
        ];
    }
}
