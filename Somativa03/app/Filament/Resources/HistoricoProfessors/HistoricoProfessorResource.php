<?php

namespace App\Filament\Resources\HistoricoProfessors;

use App\Filament\Resources\HistoricoProfessors\Pages;
use App\Models\Registro;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HistoricoProfessorResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static ?string $navigationLabel = 'Histórico da Turma';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    // Garante que o link do menu só apareça para professores
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->role === 'professor';
    }

    // Filtra a tabela para que o professor só veja registros e tenha acesso seguro
    public static function getEloquentQuery(): Builder
    {
        // Se não for professor, bloqueia trazendo nenhum resultado
        if (Auth::user()?->role !== 'professor') {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        return parent::getEloquentQuery();
        
        /* DICA DE OURO: Se o seu modelo Registro tiver um relacionamento com o professor, 
        você pode filtrar para ele ver APENAS os alunos dele, assim:
        
        return parent::getEloquentQuery()->where('professor_id', Auth::id());
        */
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_aluno')
                    ->label('Aluno')
                    ->searchable(), // Adicionado para facilitar a busca

                Tables\Columns\TextColumn::make('matricula')
                    ->label('Matrícula')
                    ->searchable(),

                Tables\Columns\TextColumn::make('turma')
                    ->label('Turma'),

                Tables\Columns\TextColumn::make('tipo')
                    ->label('Registro'),

                Tables\Columns\TextColumn::make('hora')
                    ->label('Horário')
                    ->dateTime('d/m/Y H:i'), // Formata a data/hora para o padrão BR caso seja datetime

                Tables\Columns\TextColumn::make('confirmado')
                    ->label('Status')
                    ->badge() // Transforma em um modal visual mais bonito (Badge)
                    ->color(fn ($state): string => $state ? 'success' : 'warning')
                    ->formatStateUsing(fn ($state) => $state ? 'Visualizado' : 'Pendente'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistoricoProfessors::route('/'),
        ];
    }
}