<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function(Blueprint $table){
        	$table->increments('roomId');
        	$table->integer('seats')->unsigned();
        	$table->integer('loverSeats')->unsigned();
        	$table->integer('loverRow')->unsigned();
        	$table->integer('rows')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Rooms');
    }
}
