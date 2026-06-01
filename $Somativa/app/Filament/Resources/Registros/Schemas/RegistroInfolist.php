<?php

namespace App\Filament\Resources\Registros\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RegistroInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome_aluno')
                    ->label('Aluno'),
                TextEntry::make('matricula'),
                TextEntry::make('turma'),
                TextEntry::make('empresa'),
                TextEntry::make('docente'),
                TextEntry::make('tipo')
                    ->badge(),
                TextEntry::make('data')
                    ->date('d/m/Y'),
                TextEntry::make('hora')
                    ->time('H:i'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
