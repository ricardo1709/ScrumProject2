<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function(Blueprint $table){
            $table->increments('ticketId');
            $table->integer('barcode')->unsigned();
            $table->integer('movieId')->unsigned();
            $table->integer('transactionId')->unsigned();
            $table->integer('seatId')->unsigned();

            $table->foreign('movieId')->references('movieId')->on('movies');
            $table->foreign('transactionId')->references('transactionId')->on('transactions');
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
        Schema::table('tickets', function($table) {
            $table->dropForeign('tickets_movieId_foreign');
            $table->dropForeign('tickets_transactionId_foreign');
            $table->dropForeign('tickets_seatId_foreign');
        });
        Schema::dropIfExists('tickets');
    }
}
