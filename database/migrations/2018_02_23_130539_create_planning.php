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
            $table->integer('movieId')->unsigned();
            $table->integer('roomId')->unsigned();
            $table->timestamp('time');

            $table->foreign('roomId')->references('roomId')->on('rooms');
            $table->foreign('movieId')->references('movieId')->on('movies');
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
            $table->dropForeign('plannings_movieId_foreign');
        });
        Schema::dropIfExists('plannings');
    }
}
