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
    public function up(): void
    {
        Schema::create('history_budget_planners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('authorized');
            $table->unsignedBigInteger('budget_planner_id');
            $table->string('from_planner')->nullable();
            $table->string('to')->nullable();
            $table->decimal('before_amount', 20, 0);
            $table->decimal('amount', 20, 0);
            $table->decimal('after_amount', 20, 0);
            $table->enum('entry',['IN','OUT']);
            $table->enum('type',['ALLOCATED','RELOCATION','DISTRIBUTED']);
            $table->enum('method',['ALLOCATED','TRANSFER','DISTRIBUTED','REFUND']);
            $table->timestamps();

            $table->foreign('budget_planner_id')
                ->references('id')
                ->on('budget_planners')
                ->onDelete('cascade');

            $table->foreign('authorized')
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
    public function down(): void
    {
        Schema::dropIfExists('history_budget_planners');
    }
};
