<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Student extends Model
{
    protected $fillable = [

        'name',
        'classroom_id',
        'student_number',
        'email',
        'birth_date',
        'image'

    ];
    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }
}
