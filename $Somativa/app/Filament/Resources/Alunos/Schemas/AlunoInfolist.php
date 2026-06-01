<?php

namespace App\Filament\Resources\Alunos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AlunoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome')
                    ->label('Nome'),
                TextEntry::make('matricula')
                    ->label('Matrícula')
                    ->copyable(),
                TextEntry::make('turma')
                    ->label('Turma'),
                TextEntry::make('empresa')
                    ->label('Empresa'),
                TextEntry::make('docente')
                    ->label('Professor Responsável'),
                TextEntry::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
            ]);
    }
}
