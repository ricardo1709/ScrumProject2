<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function room()
    {
        return $this->hasOne(\App\Room::class, 'roomId', 'roomId');
    }

}
