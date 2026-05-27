<?php

namespace App\Filament\Resources\Portarias;

use App\Filament\Resources\Portarias\Pages;
use App\Models\Registro;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PortariaResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static ?string $navigationLabel = 'Portaria';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-key';

    // SOMENTE DIRETORIA
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->role === 'diretoria';
    }

    public static function canViewAny(): bool
    {
        return Auth::user()?->role === 'diretoria';
    }

    // MOSTRA APENAS SAÍDAS
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('tipo', 'saida');
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([

                Tables\Columns\TextColumn::make('nome_aluno')
                    ->label('Aluno'),

                Tables\Columns\TextColumn::make('matricula')
                    ->label('Matrícula'),

                Tables\Columns\TextColumn::make('turma')
                    ->label('Turma'),

                Tables\Columns\TextColumn::make('hora')
                    ->label('Horário'),

                Tables\Columns\TextColumn::make('confirmado')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Liberado' : 'Pendente'),
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortarias::route('/'),
        ];
    }
}