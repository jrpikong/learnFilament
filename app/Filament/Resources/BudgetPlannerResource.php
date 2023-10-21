<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BudgetPlannerResource\Pages;
use App\Filament\Resources\BudgetPlannerResource\RelationManagers;
use App\Models\BudgetPlanner;
use App\Services\GenerateCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BudgetPlannerResource extends Resource
{
    protected static ?string $model = BudgetPlanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Expense';

    public static function form(Form $form): Form
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
                Forms\Components\Select::make('expense_budget_id')
                    ->relationship('expenseBudget', 'code')
                    ->required(),
                Forms\Components\Select::make('branch_id')
                    ->live()
                    ->relationship('branch', 'name', fn($query, $get) => $query->where('cluster_id', $get('cluster_id')))
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\Fieldset::make('Date')
                    ->schema([
                        Forms\Components\DatePicker::make('start')
                            ->required(),
                        Forms\Components\DatePicker::make('end')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expenseBudget.code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cluster.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
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
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AccountPlannerRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBudgetPlanners::route('/'),
            'create' => Pages\CreateBudgetPlanner::route('/create'),
            'view' => Pages\ViewBudgetPlanner::route('/{record}'),
            'edit' => Pages\EditBudgetPlanner::route('/{record}/edit'),
        ];
    }
}
