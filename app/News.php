<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    function cate()
    {
        return $this->belongsTo('App\Category','cate_id');
    }

}
