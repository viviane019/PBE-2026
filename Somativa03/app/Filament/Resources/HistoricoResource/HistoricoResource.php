<?php

namespace App\Filament\Resources\Historicos;

use App\Filament\Resources\Historicos\Pages\CreateHistorico;
use App\Filament\Resources\Historicos\Pages\EditHistorico;
use App\Filament\Resources\Historicos\Pages\ListHistoricos;
use App\Filament\Resources\Historicos\Pages\ViewHistorico;
use App\Filament\Resources\Historicos\Schemas\HistoricoForm;
use App\Filament\Resources\Historicos\Schemas\HistoricoInfolist;
use App\Filament\Resources\Historicos\Tables\HistoricosTable;
use App\Models\Historico;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HistoricoResource extends Resource
{
    protected static ?string $model = Historico::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Historico';

    public static function form(Schema $schema): Schema
    {
        return HistoricoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HistoricoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistoricosTable::configure($table);
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
            'index' => ListHistoricos::route('/'),
            'create' => CreateHistorico::route('/create'),
            'view' => ViewHistorico::route('/{record}'),
            'edit' => EditHistorico::route('/{record}/edit'),
        ];
    }
}
