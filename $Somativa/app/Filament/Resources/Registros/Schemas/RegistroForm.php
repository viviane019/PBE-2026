<?php

namespace App\Filament\Resources\Registros\Schemas;

use App\Models\Aluno;
use App\Models\Registro;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class RegistroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Dados do Aluno')
                ->description('Selecione o aluno — os campos abaixo serão preenchidos automaticamente.')
                ->schema([
                    Select::make('nome_aluno')
                        ->label('Nome do Aluno')
                        ->options(Aluno::pluck('nome', 'nome'))
                        ->searchable()
                        ->preload()
                        ->required()
                        ->autofocus()
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
                                    ->where('confirmado', false)
                                    ->exists();

                                if ($jaExiste) {
                                    $fail('Este aluno já possui uma saída pendente e ainda não foi liberado na portaria.');
                                }
                            },
                        ]),

                    Grid::make(3)
                        ->schema([
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
                        ]),
                ]),

            Section::make('Detalhes do Registro')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('tipo')
                                ->label('Tipo de Registro')
                                ->options([
                                    'entrada' => 'Entrada (Atraso / Retorno)',
                                    'saida'   => 'Saída Antecipada',
                                ])
                                ->required(),

                            TextInput::make('docente')
                                ->label('Professor / Docente Responsável')
                                ->placeholder('Nome do professor')
                                ->required(),

                            DatePicker::make('data')
                                ->label('Data')
                                ->default(now())
                                ->required(),

                            TimePicker::make('hora')
                                ->label('Horário')
                                ->default(now()->format('H:i'))
                                ->required(),
                        ]),

                    TextInput::make('nome_diretora')
                        ->label('Diretora Responsável')
                        ->default(fn () => auth()->user()->name)
                        ->disabled()
                        ->dehydrated()
                        ->helperText('Preenchido automaticamente com o usuário logado.'),
                ]),

        ]);
    }
}
