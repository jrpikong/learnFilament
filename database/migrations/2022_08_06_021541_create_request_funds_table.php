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
        Schema::create('request_funds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('budget_planner_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('created_by');
            $table->decimal('amount',20,0);
            $table->string('note');
            $table->timestamps();

            $table->foreign('budget_planner_id')
                ->references('id')
                ->on('budget_planners')
                ->onDelete('cascade');

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('request_funds');
    }
};
