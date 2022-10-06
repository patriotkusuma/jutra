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
        Schema::dropIfExists('brokers');
        Schema::create('brokers', function (Blueprint $table) {
            $table->id();
            $table->char('broker_code',4);
            $table->string('name');
            $table->integer('user_id');
            $table->float('buy_fee',5)->nullable();
            $table->float('sell_fee',5)->nullable();
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
        Schema::dropIfExists('brokers');
    }
};
