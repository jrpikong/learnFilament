<?php

namespace App\Filament\Resources\AccountPlannerResource\Pages;

use App\Filament\Resources\AccountPlannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccountPlanner extends EditRecord
{
    protected static string $resource = AccountPlannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
