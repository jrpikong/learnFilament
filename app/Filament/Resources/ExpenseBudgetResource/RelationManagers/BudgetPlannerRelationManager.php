<?php

namespace App\Filament\Resources\ExpenseBudgetResource\RelationManagers;

use App\Models\BudgetPlanner;
use App\Services\GenerateCode;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BudgetPlannerRelationManager extends RelationManager
{
    protected static string $relationship = 'budgetPlanner';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->readOnly()
                    ->default(function () {
                        return GenerateCode::create(BudgetPlanner::class, 'code', 'BPL');
                    })
                    ->maxLength(255),
                Forms\Components\Select::make('cluster_id')
                    ->relationship('cluster', 'name')
                    ->live()
                    ->required(),
                Forms\Components\Select::make('branch_id')
                    ->live()
                    ->relationship('branch', 'name', fn($query, $get) => $query->where('cluster_id', $get('cluster_id')))
                    ->required(),
                TextInput::make('total_amount')
                    ->required()
                    ->live()
                    ->debounce(600)
                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2),
                Forms\Components\DatePicker::make('start')
                    ->required(),
                Forms\Components\DatePicker::make('end')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('cluster.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expenseBudget.code')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->currency('IDR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
