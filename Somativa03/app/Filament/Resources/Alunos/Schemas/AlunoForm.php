<?php

namespace App\Filament\Resources\Alunos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AlunoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->required(),
                TextInput::make('matricula')
                    ->required(),
                TextInput::make('turma')
                    ->required(),
                TextInput::make('empresa')
                    ->required(),
                TextInput::make('docente')
                    ->required(),
            ]);
    }
}
