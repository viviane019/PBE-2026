<?php

namespace App\Filament\Resources\Historicos\Pages;

use App\Filament\Resources\Historicos\HistoricoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHistorico extends EditRecord
{
    protected static string $resource = HistoricoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
