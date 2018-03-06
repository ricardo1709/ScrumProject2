<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{


    public function reserve()
    {
        return $this->hasOne(\App\Reserve::class, 'ticketId', 'ticketId');
    }

    public function transaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'transactionId', 'transactionId');
    }
}
