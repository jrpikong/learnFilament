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
        Schema::create('account_planner_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('authorized');
            $table->unsignedBigInteger('account_planner_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('ref_id')->nullable();
            $table->string('account_name');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->decimal('before_amount', 20, 0);
            $table->decimal('amount', 20, 0);
            $table->decimal('after_amount', 20, 0);
            $table->enum('entry',['IN','OUT']);
            $table->enum('type',['ALLOCATED','RELOCATION','EXPENSED']);
            $table->enum('method',['ALLOCATED','TRANSFER','EXPENSED','REFUND']);

            $table->foreign('account_planner_id')
                ->references('id')
                ->on('account_planners')
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
        Schema::dropIfExists('account_planner_histories');
    }
};
