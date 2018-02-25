<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function(Blueprint $table){
            $table->increments('reservesId');
            $table->integer('userId')->unsigned();
            $table->integer('movieId')->unsigned();
            $table->integer('transactionId')->unsigned();
            $table->integer('seatId')->unsigned();
            $table->integer('ticketId')->unsigned();

            $table->foreign('movieId')->references('movieId')->on('movies');
            $table->foreign('transactionId')->references('transactionId')->on('transactions');
            $table->foreign('seatId')->references('seatId')->on('seats');
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('ticketId')->references('ticketId')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reserves', function($table) {
            $table->dropForeign('reserves_movieId_foreign');
            $table->dropForeign('reserves_transactionId_foreign');
            $table->dropForeign('reserves_seatId_foreign');
            $table->dropForeign('reserves_userId_foreign');
            $table->dropForeign('reserves_ticketId_foreign');
        });
        Schema::dropIfExists('reserves');
    }
}
