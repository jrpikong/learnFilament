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
        Schema::create('request_fund_status_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('request_fund_id');
            $table->tinyInteger('status');
            $table->text('attachment')->nullable();
            $table->unsignedBigInteger('authorized');
            $table->timestamps();

            $table->foreign('request_fund_id')
                ->references('id')
                ->on('request_funds')
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
    public function down()
    {
        Schema::dropIfExists('request_fund_status_histories');
    }
};
