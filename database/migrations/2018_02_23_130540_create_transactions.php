<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table){
            $table->increments('transactionId');
            $table->decimal('payedAmount', 8, 2);
            $table->integer('movieId')->unsigned();
            $table->integer('userId')->unsigned();
            $table->string('payment_status')->nullable();

            $table->foreign('movieId')->references('movieId')->on('movies');
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function($table) {
            $table->dropForeign('transactions_movieId_foreign');
            $table->dropForeign('transactions_userId_foreign');
        });
        Schema::dropIfExists('transactions');
    }
}
