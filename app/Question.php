<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['question_type', 'question'];

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
