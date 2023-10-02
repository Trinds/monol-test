<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
}
