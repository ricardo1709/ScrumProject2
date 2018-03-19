<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function room()
    {
        return $this->hasOne(\App\Room::class, 'roomId', 'roomId');
    }
    
    public function reserve(bool $value)
    {
        $this->isGereserveerd = $value;
        $this->save();
    }

}
