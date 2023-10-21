<?php

namespace App\Filament\Resources\BudgetPlannerResource\Pages;

use App\Filament\Resources\BudgetPlannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBudgetPlanner extends ViewRecord
{
    protected static string $resource = BudgetPlannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
