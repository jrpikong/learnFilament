<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_planners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->unsignedBigInteger('expense_budget_id');
            $table->unsignedBigInteger('branch_id');
            $table->decimal('total_amount',20,0)->default(0);
            $table->date('start');
            $table->date('end');
            $table->tinyInteger('status');

            $table->foreign('expense_budget_id')
                ->references('id')
                ->on('expense_budgets')
                ->onDelete('cascade');

            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_planners');
    }
};
