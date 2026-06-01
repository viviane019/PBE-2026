<?php

namespace App\Filament\Resources\Docentes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocenteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required(),
                TextInput::make('matricula')
                    ->label('Matrícula'),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email(),
                TextInput::make('telefone')
                    ->label('Telefone'),
            ]);
    }
}
