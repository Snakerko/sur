<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';
    
    protected $fillable = ['org_name'];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
