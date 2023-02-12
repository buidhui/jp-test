<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table ='test';

    public function round()
    {
        return $this->belongsTo('App\Round','round_id');
    }

    public function cate()
    {
        return $this->belongsTo('App\CateTest','cate_test_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher','teacher_id');
    }
}
