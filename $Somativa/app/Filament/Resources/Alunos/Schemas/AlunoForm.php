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
                    ->required()
                    ->autofocus()
                    ->placeholder('Nome completo do aluno'),

                TextInput::make('matricula')
                    ->label('Matrícula')
                    ->required()
                    ->placeholder('Ex: 2024001')
                    ->rules([
                        fn ($record) => Rule::unique('alunos', 'matricula')
                            ->ignore($record?->id),
                    ])
                    ->validationMessages([
                        'unique' => 'Já existe um aluno cadastrado com esse número de matrícula.',
                    ]),

                TextInput::make('turma')
                    ->label('Turma')
                    ->required()
                    ->placeholder('Ex: DS3A'),

                TextInput::make('empresa')
                    ->label('Empresa')
                    ->placeholder('Deixe em branco se não tiver empresa vinculada')
                    ->helperText('Preencha apenas para alunos do programa Jovem Aprendiz.'),

                TextInput::make('docente')
                    ->label('Professor Responsável')
                    ->required()
                    ->placeholder('Nome do professor orientador'),
            ]);
    }
}