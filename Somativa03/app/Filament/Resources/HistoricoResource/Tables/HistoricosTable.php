<?php

namespace App\Filament\Resources\Historicos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class HistoricosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('aluno')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('matricula')
                    ->label('Matrícula')
                    ->searchable(),

                TextColumn::make('turma')
                    ->label('Turma'),

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Entrada' => 'success',
                        'Saida' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('data')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('horario')
                    ->label('Horário'),

                TextColumn::make('motivo')
                    ->label('Motivo')
                    ->limit(30),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Registrado' => 'success',
                        'Pendente' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('diretor_responsavel')
                    ->label('Diretora'),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}