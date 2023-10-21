<?php

namespace App\Filament\Resources\BudgetPlannerResource\Pages;

use App\Filament\Resources\BudgetPlannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBudgetPlanner extends EditRecord
{
    protected static string $resource = BudgetPlannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
