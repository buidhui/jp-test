<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTraining extends Model
{
    protected $table = 'question_trainings';

    public function cate()
    {
        return $this->belongsTo('App\CateTest','cate_test_id');
    }
}
