<?php

namespace App\Filament\Resources\ExpenseBudgetResource\Pages;

use App\Filament\Resources\ExpenseBudgetResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpenseBudget extends CreateRecord
{
    protected static string $resource = ExpenseBudgetResource::class;
}
