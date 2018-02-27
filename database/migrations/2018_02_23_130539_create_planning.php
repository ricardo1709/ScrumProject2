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
            $table->integer('zaalId')->unsigned();
            $table->timestamps();

            $table->foreign('zaalId')->references('zaalId')->on('zaals');
            $table->foreign('seatId')->references('seatId')->on('seats');
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
            $table->dropForeign('plannings_zaalId_foreign');
            $table->dropForeign('plannings_seatID_foreign');
        });
        Schema::dropIfExists('plannings');
    }
}
