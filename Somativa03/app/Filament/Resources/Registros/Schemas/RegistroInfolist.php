<?php

namespace App\Filament\Resources\Registros\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RegistroInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('aluno_id')
                    ->numeric(),
                TextEntry::make('tipo')
                    ->badge(),
                TextEntry::make('data')
                    ->date(),
                TextEntry::make('horario')
                    ->time(),
                TextEntry::make('motivo')
                    ->columnSpanFull(),
                IconEntry::make('possui_declaracao')
                    ->boolean(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('diretor_responsavel'),
                TextEntry::make('assinatura'),
                TextEntry::make('observacoes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
