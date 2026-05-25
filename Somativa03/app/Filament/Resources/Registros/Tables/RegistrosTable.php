<?php

namespace App\Filament\Resources\Registros\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegistrosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('aluno_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipo')
                    ->badge(),
                TextColumn::make('data')
                    ->date()
                    ->sortable(),
                TextColumn::make('horario')
                    ->time()
                    ->sortable(),
                IconColumn::make('possui_declaracao')
                    ->boolean(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('diretor_responsavel')
                    ->searchable(),
                TextColumn::make('assinatura')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
