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
        Schema::create('emitens', function (Blueprint $table) {
            $table->id();
            $table->char('code',4);
            $table->string('name');
            $table->dateTime('listing_date');
            $table->bigInteger('shares');
            $table->enum('listing_board',['Utama','Pengembangan','Akselerasi'])->default('Pengembangan');
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
        Schema::dropIfExists('emitens');
    }
};
