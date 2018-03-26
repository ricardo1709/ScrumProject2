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
        Schema::create('seats', function(Blueprint $table){
            $table->increments('seatId');
            $table->integer('roomId')->unsigned();
            $table->boolean('isGereserveerd');
            $table->boolean('isLoveseat')->default(0);

            $table->foreign('roomId')->references('roomId')->on('rooms');
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
            $table->dropForeign('Seats_roomId_foreign');
        });
        Schema::dropIfExists('Seats');
    }
}
