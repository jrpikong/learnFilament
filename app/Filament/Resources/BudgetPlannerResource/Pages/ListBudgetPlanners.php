<?php

namespace App\Filament\Resources\BudgetPlannerResource\Pages;

use App\Filament\Resources\BudgetPlannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBudgetPlanners extends ListRecords
{
    protected static string $resource = BudgetPlannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
