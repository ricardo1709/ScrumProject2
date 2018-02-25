<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZaals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Zaals', function(Blueprint $table){
        	$table->increments('zaalId');
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
        Schema::dropIfExists('Zaals');
    }
}
