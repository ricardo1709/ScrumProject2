<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public function tickets()
    {
        return $this->hasMany(\App\Ticket::class, 'transactionId', 'transactionId');
    }

    public function reserves()
    {
        return $this->hasMany(\App\Reserve::class, 'transactionId', 'transactionId');
    }

}
