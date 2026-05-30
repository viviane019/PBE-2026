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
                TextColumn::make('nome_aluno')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('matricula')
                    ->label('Matrícula')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('turma')
                    ->label('Turma')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'saida'   => 'danger',
                        'entrada' => 'success',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('data')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('hora')
                    ->label('Horário')
                    ->time('H:i'),

                TextColumn::make('confirmado')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Liberado' : 'Pendente')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),

                TextColumn::make('docente')
                    ->label('Professor')
                    ->toggleable(),

                TextColumn::make('empresa')
                    ->label('Empresa')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->emptyStateHeading('Nenhum registro encontrado')
            ->emptyStateDescription('Os registros de entrada e saída de alunos aparecerão aqui.')
            ->emptyStateIcon('heroicon-o-clipboard-document-list')
            ->defaultSort('data', 'desc')
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation(),
            ]);
    }
}
