<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $table = 'round';

    public function userPassRounds()
    {
        return $this->hasMany('App\UserPassRound');
    }
}
