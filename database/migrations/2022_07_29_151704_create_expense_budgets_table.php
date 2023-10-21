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
        Schema::create('expense_budgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->bigInteger('amount');
            $table->unsignedBigInteger('budget_type_id');
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('cluster_id');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('budget_type_id')
                ->references('id')
                ->on('budget_types')
                ->onDelete('cascade');

            $table->foreign('period_id')
                ->references('id')
                ->on('periods')
                ->onDelete('cascade');

            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('cascade');

            $table->foreign('cluster_id')
                ->references('id')
                ->on('clusters')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_budgets');
    }
};
