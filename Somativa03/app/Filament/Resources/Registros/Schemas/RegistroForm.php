<?php

namespace App\Filament\Resources\Registros\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;

class RegistroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Registro')
                    ->schema([

                        TextInput::make('matricula')
                            ->required(),

                        TextInput::make('aluno'),

                        TextInput::make('turma'),

                        TextInput::make('empresa'),

                        TextInput::make('docente'),

                        TextInput::make('tipo'),

                        DatePicker::make('data'),

                        TimePicker::make('horario'),

                        TextInput::make('diretoria'),

                        Select::make('status')
                            ->options([
                                'Pendente' => 'Pendente',
                                'Aprovado' => 'Aprovado',
                                'Negado' => 'Negado',
                            ]),

                        TextInput::make('declaracao'),

                        TextInput::make('motivo'),

                        Textarea::make('observacao'),

                    ])

            ]);
    }
}