<?php

namespace App\Filament\Resources\HistoricoProfessors\Pages;

use App\Filament\Resources\HistoricoProfessors\HistoricoProfessorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHistoricoProfessor extends ViewRecord
{
    protected static string $resource = HistoricoProfessorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
