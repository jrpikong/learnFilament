<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseBudgetResource\Pages;
use App\Filament\Resources\ExpenseBudgetResource\RelationManagers\BudgetPlannerRelationManager;
use App\Models\ExpenseBudget;
use App\Services\GenerateCode;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExpenseBudgetResource extends Resource
{
    protected static ?string $model = ExpenseBudget::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Expense';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(array(
                TextInput::make('code')
                    ->readOnly()
                    ->default(function () {
                        return GenerateCode::create(self::$model, 'code', 'EXB');
                    })
                    ->maxLength(255),
                Forms\Components\Select::make('budget_type_id')
                    ->relationship('budgetType', 'name')
                    ->required(),
                Forms\Components\Select::make('period_id')
                    ->relationship(
                        name: 'period',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn(Builder $query) => $query->where('start', '<=', Carbon::now()->toDate())->where('end', '>=', Carbon::now()->toDate()))
                    ->required()
                    ->createOptionForm(fn(Form $form) => PeriodResource::form($form))
                    ->editOptionForm(fn(Form $form) => PeriodResource::form($form)),
                Forms\Components\Select::make('cluster_id')
                    ->live()
                    ->relationship('cluster', 'name')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->live()
                    ->debounce(600)
                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('budgetType.name')
                    ->sortable(),
                TextColumn::make('period.name')
                    ->sortable(),
                TextColumn::make('cluster.name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('amount')
                    ->currency('IDR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            BudgetPlannerRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenseBudgets::route('/'),
            'create' => Pages\CreateExpenseBudget::route('/create'),
            'view' => Pages\ViewExpenseBudget::route('/{record}'),
            'edit' => Pages\EditExpenseBudget::route('/{record}/edit'),
        ];
    }
}
