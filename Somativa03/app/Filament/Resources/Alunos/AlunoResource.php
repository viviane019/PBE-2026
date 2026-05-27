<?php

namespace App\Filament\Resources\Alunos;

use App\Filament\Resources\Alunos\Pages\CreateAluno;
use App\Filament\Resources\Alunos\Pages\EditAluno;
use App\Filament\Resources\Alunos\Pages\ListAlunos;
use App\Filament\Resources\Alunos\Pages\ViewAluno;
use App\Filament\Resources\Alunos\Schemas\AlunoForm;
use App\Filament\Resources\Alunos\Schemas\AlunoInfolist;
use App\Filament\Resources\Alunos\Tables\AlunosTable;
use App\Models\Aluno;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class AlunoResource extends Resource
{
    protected static ?string $model = Aluno::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Aluno';

    // NOME DO MENU
    protected static ?string $navigationLabel = 'Alunos';

    // SOMENTE DIRETORIA VÊ
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->role === 'diretoria';
    }

    // SOMENTE DIRETORIA ACESSA
    public static function canViewAny(): bool
    {
        return Auth::user()?->role === 'diretoria';
    }

    // SOMENTE DIRETORIA CRIA
    public static function canCreate(): bool
    {
        return Auth::user()?->role === 'diretoria';
    }

    // SOMENTE DIRETORIA EDITA
    public static function canEdit($record): bool
    {
        return Auth::user()?->role === 'diretoria';
    }

    // SOMENTE DIRETORIA EXCLUI
    public static function canDelete($record): bool
    {
        return Auth::user()?->role === 'diretoria';
    }

    public static function form(Schema $schema): Schema
    {
        return AlunoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AlunoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlunosTable::configure($table);
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
            'index' => ListAlunos::route('/'),
            'create' => CreateAluno::route('/create'),
            'view' => ViewAluno::route('/{record}'),
            'edit' => EditAluno::route('/{record}/edit'),
        ];
    }
}