<?php

namespace App\Filament\Resources\HistoricoProfessors;

use App\Enums\UserRole;
use App\Models\Registro;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class HistoricoProfessorResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Aprovações';

    public static function shouldRegisterNavigation(): bool
    {
        $role = Auth::user()?->role;
        return $role === UserRole::Professor || $role === UserRole::Docente;
    }

    public static function canViewAny(): bool
    {
        $role = Auth::user()?->role;
        return $role === UserRole::Professor || $role === UserRole::Docente;
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
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'saida'   => 'danger',
                        'entrada' => 'success',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('data')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('hora')
                    ->label('Horário')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('docente')
                    ->label('Professor'),

                Tables\Columns\TextColumn::make('confirmado')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Liberado' : 'Pendente')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),
            ])
            ->emptyStateHeading('Nenhum registro pendente')
            ->emptyStateDescription('Quando alunos solicitarem saída, os registros aparecerão aqui para aprovação.')
            ->emptyStateIcon('heroicon-o-academic-cap')
            ->actions([
                Action::make('aprovar')
                    ->label('Aprovar')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Aprovar saída')
                    ->modalDescription('Confirma que autoriza a saída deste aluno?')
                    ->action(fn ($record) => $record->update(['confirmado' => true])),

                Action::make('recusar')
                    ->label('Recusar')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Recusar e excluir registro')
                    ->modalDescription('Esta ação excluirá o registro permanentemente. Deseja continuar?')
                    ->action(fn ($record) => $record->delete()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\HistoricoProfessors\Pages\ListHistoricoProfessors::route('/'),
        ];
    }
}
