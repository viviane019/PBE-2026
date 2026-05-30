<?php

namespace App\Filament\Resources\Portarias\Pages;

use App\Filament\Resources\Portarias\PortariaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPortaria extends EditRecord
{
    protected static string $resource = PortariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
