<?php

namespace App\Filament\Resources\AddOnCategories;

use App\Filament\Resources\AddOnCategories\Pages\CreateAddOnCategories;
use App\Filament\Resources\AddOnCategories\Pages\EditAddOnCategories;
use App\Filament\Resources\AddOnCategories\Pages\ListAddOnCategories;
use App\Filament\Resources\AddOnCategories\Schemas\AddOnCategoriesForm;
use App\Filament\Resources\AddOnCategories\Tables\AddOnCategoriesTable;
use App\Filament\Resources\AddOnCategories\RelationManagers\AddonsRelationManager;
use App\Models\AddOnCategories;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AddOnCategoriesResource extends Resource
{
    protected static ?string $model = AddOnCategories::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Addon Setup';

    // FIX: use the actual column name from your model
    protected static ?string $recordTitleAttribute = 'category_name';

    public static function form(Schema $schema): Schema
    {
        return AddOnCategoriesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AddOnCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AddonsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAddOnCategories::route('/'),
            'create' => CreateAddOnCategories::route('/create'),
            'edit' => EditAddOnCategories::route('/{record}/edit'),
        ];
    }
}
