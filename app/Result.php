<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'result';
    public function test()
    {
        return $this->belongsTo('App\Test','test_id');

    }
}
