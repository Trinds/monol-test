<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use softDeletes;
    protected $fillable = ['name', 'abbreviation'];
    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }

}
