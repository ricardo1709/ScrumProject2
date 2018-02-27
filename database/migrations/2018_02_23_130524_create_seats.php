<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Seats', function(Blueprint $table){
            $table->increments('seatId');
            $table->integer('zaalId')->unsigned();
            $table->boolean('isGereserveerd');

            $table->foreign('zaalId')->references('zaalId')->on('Zaals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Seats', function($table) {
            $table->dropForeign('Seats_zaalId_foreign');
        });
        Schema::dropIfExists('Seats');
    }
}
