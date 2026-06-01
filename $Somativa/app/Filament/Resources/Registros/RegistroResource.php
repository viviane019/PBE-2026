<?php

namespace App\Filament\Resources\Registros;

use App\Enums\UserRole;
use App\Filament\Resources\Registros\Pages\CreateRegistro;
use App\Filament\Resources\Registros\Pages\EditRegistro;
use App\Filament\Resources\Registros\Pages\ListRegistros;
use App\Filament\Resources\Registros\Pages\ViewRegistro;
use App\Filament\Resources\Registros\Schemas\RegistroForm;
use App\Filament\Resources\Registros\Schemas\RegistroInfolist;
use App\Filament\Resources\Registros\Tables\RegistrosTable;
use App\Models\Registro;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class RegistroResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'nome_aluno';

    protected static ?string $navigationLabel = 'Registros';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->role === UserRole::Diretoria;
    }

    public static function canViewAny(): bool
    {
        return Auth::user()?->role === UserRole::Diretoria;
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->role === UserRole::Diretoria;
    }

    public static function canEdit($record): bool
    {
        return Auth::user()?->role === UserRole::Diretoria;
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->role === UserRole::Diretoria;
    }

    public static function form(Schema $schema): Schema
    {
        return RegistroForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RegistroInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListRegistros::route('/'),
            'create' => CreateRegistro::route('/create'),
            'view'   => ViewRegistro::route('/{record}'),
            'edit'   => EditRegistro::route('/{record}/edit'),
        ];
    }
}
