<?php

namespace App\Filament\Resources\Alunos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class AlunoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome do Aluno')
                    ->required(),

                TextInput::make('matricula')
                    ->label('Matrícula')
                    ->required()
                    ->rules([
                        fn ($record) => Rule::unique('alunos', 'matricula')
                            ->ignore($record?->id),
                    ])
                    ->validationMessages([
                        'unique' => 'Já existe um aluno cadastrado com esse número de matrícula.',
                    ]),

                TextInput::make('turma')
                    ->label('Turma')
                    ->required(),

                TextInput::make('empresa')
                    ->label('Empresa')
                    ->required(),

                TextInput::make('docente')
                    ->label('Professor Responsável')
                    ->required(),
            ]);
    }
}