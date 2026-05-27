<?php

namespace App\Filament\Resources\Registros\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn; // Caso precise alterar status direto
use Filament\Tables\Actions\Action; // 👈 Importação correta e oficial do Filament V3

class RegistrosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('matricula')->label('Matrícula')->searchable(),
                TextColumn::make('aluno')->label('Aluno')->searchable(),
                TextColumn::make('turma')->label('Turma')->searchable(),
                TextColumn::make('empresa')->label('Empresa'),
                TextColumn::make('tipo')->label('Tipo')->formatStateUsing(fn ($state) => ucfirst($state)),
                TextColumn::make('horario')->label('Horário'),
                TextColumn::make('docente')->label('Professor'),
                
                // No Filament V3, TextColumn substitui o BadgeColumn usando o método ->badge()
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendente' => 'warning',
                        'liberado' => 'success',
                        'recusado' => 'danger',
                        default => 'secondary',
                    }),
            ])
            ->actions([
                // Botão de confirmação usando a Action nativa do Filament V3
                Action::make('confirmarAcesso')
                    ->label('Confirmar Passagem')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pendente')
                    ->action(function ($record) {
                        $record->update(['status' => 'liberado']);
                    }),
            ]);
    }
}