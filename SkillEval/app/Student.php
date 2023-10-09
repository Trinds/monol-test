<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Student extends Model
{
    protected $fillable = [
        'student_number', 'classroom_id', 'email', 'name', 'birth_date', 'image'
    ];
    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }

    public static function filterByClassroom($classroom_id)
    {
        if($classroom_id)
            return Student::all()->where('classroom_id', '=', $classroom_id);
        return Student::all();
    }
}
