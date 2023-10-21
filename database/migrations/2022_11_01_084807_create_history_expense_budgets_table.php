<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_expense_budgets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('expense_budget_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('amount', 20, 0);
            $table->string('references');
            $table->string('status');
            $table->timestamps();

            $table->foreign('expense_budget_id')
                ->references('id')
                ->on('expense_budgets')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_expense_budgets');
    }
};
