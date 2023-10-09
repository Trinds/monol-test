<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Student extends Model
{
    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }

    public function scopeFilterByClassroom($query, $classroom_id)
    {
        return $classroom_id && $classroom_id > 0 ?
            $query->where('classroom_id', $classroom_id)
            : $query;
    }

    public function scopeSearchStudents($query, $searchParam)
    {
        return $searchParam ?
            $query->where(strtolower('name'), 'LIKE', '%' . strtolower($searchParam) . '%')
            : $query;
    }
}
