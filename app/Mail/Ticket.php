<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Ticket extends Mailable
{
    use Queueable, SerializesModels;

    var $transaction;

    /**
     * Create a new message instance.
     *
     * @param $transaction
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tickets = \App\Transaction::query()->where('transactionId', '=', $this->transaction)->first()->tickets;

        return $this->view('mails.tickets', compact('tickets'));
    }
}
