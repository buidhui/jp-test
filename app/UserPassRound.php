<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPassRound extends Model
{
    protected $table = 'user_pass_round';

    public function round()
    {
        return $this->belongsTo('App\Round','round_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
