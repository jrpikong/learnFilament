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
        Schema::create('account_planners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('budget_planner_id');
            $table->unsignedBigInteger('account_id');
            $table->string('note');
            $table->decimal('amount',20,0);

            $table->foreign('budget_planner_id')
                ->references('id')
                ->on('budget_planners')
                ->onDelete('cascade');

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
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
        Schema::dropIfExists('account_planners');
    }
};
