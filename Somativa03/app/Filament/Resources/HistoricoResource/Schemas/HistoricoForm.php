<?php

namespace App\Filament\Resources\Historicos\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;

class HistoricoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('aluno')
                    ->label('Aluno')
                    ->disabled(),

                TextInput::make('matricula')
                    ->label('Matrícula')
                    ->disabled(),

                TextInput::make('turma')
                    ->disabled(),

                TextInput::make('empresa')
                    ->disabled(),

                TextInput::make('docente')
                    ->label('Professor')
                    ->disabled(),

                Select::make('tipo')
                    ->options([
                        'Entrada' => 'Entrada',
                        'Saida' => 'Saída',
                    ])
                    ->disabled(),

                DatePicker::make('data')
                    ->disabled(),

                TimePicker::make('horario')
                    ->seconds(false)
                    ->disabled(),

                Toggle::make('possui_declaracao')
                    ->label('Possui declaração?')
                    ->disabled(),

                Textarea::make('motivo')
                    ->disabled(),

                Textarea::make('observacoes')
                    ->disabled(),

                TextInput::make('diretor_responsavel')
                    ->label('Diretora Responsável')
                    ->disabled(),

                Select::make('status')
                    ->options([
                        'Pendente' => 'Pendente',
                        'Registrado' => 'Registrado',
                    ])
                    ->disabled(),

            ]);
    }
}