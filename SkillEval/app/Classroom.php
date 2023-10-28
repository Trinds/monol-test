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

    public static function boot()
    {
        parent::boot();

        self::deleting(function (Classroom $event) {

            foreach ($event->students as $student) {
                $student->delete();
            }
        });
    }

    public function getStudentsEvaluations(Classroom $classroom): array
    {
        $techAvg = [
            'Todos' => [], 'Inicial' => [], 'Intermédio' => [], 'Final' => []
        ];
        $psychAvg = [
            'Todos' => [], 'Inicial' => [], 'Intermédio' => [], 'Final' => []
        ];
        $classTechEval = [];
        $classPsychoEval = [];
        foreach ($classroom->students as $student) {
            list($techStudent, $psychStudent) = $student->getStudentScores($student);
            $classTechEval[] = $techStudent;
            $classPsychoEval[] = $psychStudent;
            foreach (['Todos', 'Inicial', 'Intermédio', 'Final'] as $moment) {
                if (isset($techStudent[$moment])) {
                    $techAvg[$moment][] = $techStudent[$moment];
                }
                if (isset($psychStudent[$moment])) {
                    $psychAvg[$moment][] = $psychStudent[$moment];
                }
            }
        }
        return [$classTechEval, $classPsychoEval, $techAvg, $psychAvg];
    }

    public function calculateClassAvgs($techGrades, $psychGrades): array
    {
        foreach (['Todos', 'Inicial', 'Intermédio', 'Final'] as $moment) {
            if (count($techGrades[$moment]) > 0) {
                $techAvg[$moment] = floatval(array_sum($techGrades[$moment]) / count($techGrades[$moment]));
            } else {
                $techAvg[$moment] = 0;
            }
            if (count($psychGrades[$moment]) > 0) {
                $psychAvg[$moment] = floatval(array_sum($psychGrades[$moment]) / count($psychGrades[$moment]));
            } else {
                $psychAvg[$moment] = 0;
            }
        }
        return [$techAvg, $psychAvg];
    }
}
