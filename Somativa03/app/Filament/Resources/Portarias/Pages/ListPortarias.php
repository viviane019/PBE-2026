<?php

namespace App\Filament\Resources\Portarias\Pages;

use App\Filament\Resources\Portarias\PortariaResource;
use Filament\Resources\Pages\ListRecords;

class ListPortarias extends ListRecords
{
    protected static string $resource = PortariaResource::class;

    protected array $actions = [];

    // Força o cabeçalho a não ter NENHUM botão de criar para não gerar erros de banco
    protected function getHeaderActions(): array
    {
        return [];
    }
}