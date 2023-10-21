<?php

namespace App\Filament\Resources\AccountPlannerResource\Pages;

use App\Filament\Resources\AccountPlannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAccountPlanner extends ViewRecord
{
    protected static string $resource = AccountPlannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
