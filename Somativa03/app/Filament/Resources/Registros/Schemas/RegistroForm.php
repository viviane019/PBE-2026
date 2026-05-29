<?php

namespace App\Filament\Resources\Registros\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use App\Models\Aluno;
use App\Models\Registro;

class RegistroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Select::make('nome_aluno')
                ->label('Nome do Aluno')
                ->options(Aluno::pluck('nome', 'nome'))
                ->searchable()
                ->preload()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state) {
                        $aluno = Aluno::where('nome', $state)->first();
                        if ($aluno) {
                            $set('matricula', $aluno->matricula);
                            $set('turma', $aluno->turma);
                            $set('empresa', $aluno->empresa);
                        }
                    }
                })
                ->rules([
                    fn () => function (string $attribute, $value, \Closure $fail) {
                        $jaExiste = Registro::where('nome_aluno', $value)
                            ->whereRaw('(confirmado IS NULL OR confirmado = 0)')
                            ->exists();

                        if ($jaExiste) {
                            $fail("Este aluno já possui uma saída pendente e ainda não foi liberado na portaria.");
                        }
                    },
                ]),

            TextInput::make('matricula')
                ->label('Matrícula')
                ->disabled()
                ->dehydrated()
                ->required(),

            TextInput::make('turma')
                ->label('Turma')
                ->disabled()
                ->dehydrated()
                ->required(),

            TextInput::make('empresa')
                ->label('Empresa / Jovem Aprendiz')
                ->disabled()
                ->dehydrated()
                ->placeholder('Nenhuma empresa vinculada'),

            Select::make('tipo')
                ->label('Tipo de Registro')
                ->options([
                    'entrada' => 'Entrada (Atraso / Retorno)',
                    'saida'   => 'Saída Antecipada',
                ])
                ->required(),

            DatePicker::make('data')
                ->label('Data')
                ->default(now())
                ->required(),

            TimePicker::make('hora')
                ->label('Horário')
                ->default(now()->format('H:i'))
                ->required(),

            TextInput::make('docente')
                ->label('Professor / Docente Responsável')
                ->placeholder('Nome do professor')
                ->required(),

            TextInput::make('nome_diretora')
                ->label('Diretora Responsável')
                ->default(fn () => auth()->user()->name)
                ->required(),

        ]);
    }
}