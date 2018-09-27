<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = ['report_1', 'report_2'];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function answers()
    {
        return $this->belongsToMany('App\Answer');
    }
}
