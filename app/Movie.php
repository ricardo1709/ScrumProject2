<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    public function planning()
    {
        return $this->hasOne(\App\Planning::class, 'movieId', 'movieId');
    }

}
