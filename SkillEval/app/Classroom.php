<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use softDeletes;
    protected $fillable = [
        'edition', 'course_id', 'start_date', 'end_date',
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public static function boot ()
    {
        parent::boot();

        self::deleting(function (Classroom $event) {

            foreach ($event->students as $student)
            {
                $student->delete();
            }
        });
    }
}
