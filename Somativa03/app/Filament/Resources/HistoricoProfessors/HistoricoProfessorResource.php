<?php

namespace App\Filament\Resources\Professores;

use App\Models\Registro;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class ProfessorResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Professor';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->role === 'professor' || Auth::user()?->role === 'docente';
    }

    public static function canViewAny(): bool
    {
        return Auth::user()?->role === 'professor' || Auth::user()?->role === 'docente';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_aluno')
                    ->label('Aluno')
                    ->searchable(),

                Tables\Columns\TextColumn::make('turma')
                    ->label('Turma'),

                Tables\Columns\TextColumn::make('empresa')
                    ->label('Empresa'),

                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('hora')
                    ->label('Horário'),

                Tables\Columns\TextColumn::make('docente')
                    ->label('Professor'),

                Tables\Columns\TextColumn::make('confirmado')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Liberado' : 'Pendente')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),
            ])
            ->actions([
                Action::make('aprovar')
                    ->label('Aprovar')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn ($record) => $record->update(['confirmado' => 1])),

                Action::make('recusar')
                    ->label('Recusar')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn ($record) => $record->delete()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Professores\Pages\ListProfessores::route('/'),
        ];
    }
}