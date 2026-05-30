<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Portarias\PortariaResource;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function mount(): void
    {
        $this->redirect(PortariaResource::getUrl('index'));
    }
}
