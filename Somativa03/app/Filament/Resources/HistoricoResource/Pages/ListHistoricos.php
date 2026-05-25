<?php

namespace App\Filament\Resources\Historicos\Pages;

use App\Filament\Resources\Historicos\HistoricoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistoricos extends ListRecords
{
    protected static string $resource = HistoricoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
