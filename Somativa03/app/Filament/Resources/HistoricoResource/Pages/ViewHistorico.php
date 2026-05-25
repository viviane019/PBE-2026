<?php

namespace App\Filament\Resources\Historicos\Pages;

use App\Filament\Resources\Historicos\HistoricoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHistorico extends ViewRecord
{
    protected static string $resource = HistoricoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
