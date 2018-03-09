<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'userId', 'id');
    }

    public function movie()
    {
        return $this->belongsTo(\App\Movie::class, 'movieId', 'movieId');
    }

    public function transaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'transactionId', 'transactionId');
    }
}
