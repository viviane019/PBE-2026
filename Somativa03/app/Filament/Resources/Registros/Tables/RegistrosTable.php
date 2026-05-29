<?php

namespace App\Filament\Resources\Registros\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class RegistrosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('matricula')
                    ->label('Matrícula')
                    ->searchable(),

                TextColumn::make('nome_aluno')
                    ->label('Aluno')
                    ->searchable(),

                TextColumn::make('turma')
                    ->label('Turma')
                    ->searchable(),

                TextColumn::make('empresa')
                    ->label('Empresa'),

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('hora')
                    ->label('Horário')
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('docente')
                    ->label('Professor'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}