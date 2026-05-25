<?php

namespace App\Filament\Resources\Portarias;

use App\Filament\Resources\Portarias\Pages\CreatePortaria;
use App\Filament\Resources\Portarias\Pages\EditPortaria;
use App\Filament\Resources\Portarias\Pages\ListPortarias;
use App\Filament\Resources\Portarias\Pages\ViewPortaria;
use App\Filament\Resources\Portarias\Schemas\PortariaForm;
use App\Filament\Resources\Portarias\Schemas\PortariaInfolist;
use App\Filament\Resources\Portarias\Tables\PortariasTable;
use App\Models\Portaria;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PortariaResource extends Resource
{
    protected static ?string $model = Portaria::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Portaria';

    public static function form(Schema $schema): Schema
    {
        return PortariaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PortariaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortariasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPortarias::route('/'),
            'create' => CreatePortaria::route('/create'),
            'view' => ViewPortaria::route('/{record}'),
            'edit' => EditPortaria::route('/{record}/edit'),
        ];
    }
}
