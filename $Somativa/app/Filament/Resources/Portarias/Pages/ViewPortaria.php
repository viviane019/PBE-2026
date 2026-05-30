<?php

namespace App\Filament\Resources\Portarias\Pages;

use App\Filament\Resources\Portarias\PortariaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPortaria extends ViewRecord
{
    protected static string $resource = PortariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
