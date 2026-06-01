<?php

namespace App\Filament\Resources\Alunos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlunosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('matricula')
                    ->label('Matrícula')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('turma')
                    ->label('Turma')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('empresa')
                    ->label('Empresa')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('docente')
                    ->label('Professor')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->emptyStateHeading('Nenhum aluno cadastrado')
            ->emptyStateDescription('Clique em "Novo aluno" para adicionar o primeiro registro.')
            ->emptyStateIcon('heroicon-o-user-group')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
