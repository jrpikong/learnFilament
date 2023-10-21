<?php

namespace App\Filament\Resources\AccountPlannerResource\Pages;

use App\Filament\Resources\AccountPlannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccountPlanners extends ListRecords
{
    protected static string $resource = AccountPlannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
