<?php

namespace App\Filament\Resources\HistoricoProfessors\Pages;

use App\Filament\Resources\HistoricoProfessors\HistoricoProfessorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHistoricoProfessor extends EditRecord
{
    protected static string $resource = HistoricoProfessorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
