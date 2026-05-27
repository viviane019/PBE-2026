<?php

namespace App\Filament\Resources\Registros\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Textarea;

class RegistroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // 1. Seleção de Matrícula (Puxa tudo do Banco de Dados)
            Select::make('matricula')
                ->label('Matrícula do Aluno')
                ->relationship('aluno', 'matricula')
                ->searchable()
                ->preload()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state) {
                        // Busca o Aluno no banco usando a matrícula selecionada
                        $dadosAluno = \App\Models\Aluno::where('matricula', $state)->first();
                        
                        if ($dadosAluno) {
                            // Preenche os três campos abaixo automaticamente!
                            $set('aluno', $dadosAluno->nome); 
                            $set('turma', $dadosAluno->turma);
                            $set('empresa', $dadosAluno->empresa); // Puxa a empresa cadastrada no Aluno
                        }
                    }
                }),

            // 2. Informações do Aluno que aparecem sozinhas (Bloqueadas para edição manual)
            TextInput::make('aluno')
                ->label('Nome do Aluno')
                ->disabled()
                ->required(),

            TextInput::make('turma')
                ->label('Turma do Aluno')
                ->disabled()
                ->required(),

            TextInput::make('empresa')
                ->label('Empresa / Jovem Aprendiz')
                ->disabled()
                ->placeholder('Nenhuma empresa vinculada'),

            // 3. Dados que a Diretoria vai preencher na hora de registrar a ocorrência
            Select::make('tipo')
                ->label('Tipo de Registro')
                ->options([
                    'entrada' => 'Entrada (Atraso / Retorno)',
                    'saida' => 'Saída Antecipada',
                ])
                ->required(),

            DatePicker::make('data')
                ->label('Data')
                ->default(now())
                ->required(),

            TimePicker::make('horario')
                ->label('Horário')
                ->default(now()->format('H:i'))
                ->required(),

            TextInput::make('docente')
                ->label('Professor / Docente Responsável')
                ->placeholder('Nome do professor que liberou ou da aula')
                ->required(),

            TextInput::make('motivo')
                ->label('Motivo do Registro')
                ->required(),

            Textarea::make('observacao')
                ->label('Observações Adicionais'),

            // Status que controla a esteira (Portaria e Docentes)
            Select::make('status')
                ->label('Status do Registro')
                ->options([
                    'pendente' => 'Aguardando Liberação na Portaria',
                    'liberado' => 'Saída/Entrada Confirmada pela Portaria',
                    'recusado' => 'Recusado/Cancelado',
                ])
                ->default('pendente')
                ->required(),
        ]);
    }
}