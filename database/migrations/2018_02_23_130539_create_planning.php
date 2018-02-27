<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanning extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plannings', function(Blueprint $table){
            $table->increments('planningId');
            $table->integer('seatId')->unsigned();
            $table->integer('roomId')->unsigned();
            $table->timestamps();

            $table->foreign('roomId')->references('roomId')->on('Rooms');
            $table->foreign('seatId')->references('seatId')->on('Seats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plannings', function($table) {
            $table->dropForeign('plannings_roomId_foreign');
            $table->dropForeign('plannings_seatID_foreign');
        });
        Schema::dropIfExists('plannings');
    }
}
