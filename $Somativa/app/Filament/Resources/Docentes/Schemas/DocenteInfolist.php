<?php

namespace App\Filament\Resources\Docentes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DocenteInfolist
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
                TextEntry::make('email')
                    ->label('E-mail'),
                TextEntry::make('telefone')
                    ->label('Telefone'),
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
