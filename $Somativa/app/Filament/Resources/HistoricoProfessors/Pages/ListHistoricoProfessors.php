<?php

namespace App\Filament\Resources\HistoricoProfessors\Pages;

use App\Filament\Resources\HistoricoProfessors\HistoricoProfessorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistoricoProfessors extends ListRecords
{
    protected static string $resource = HistoricoProfessorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
