<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Student extends Model
{
    use softDeletes;
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

    public function getStudentScores(Student $student): array
    {
        $techStudent = ['x' => $student->name];
        $psychStudent = ['x' => $student->name];

        $techEval = $student->evaluations->where('test.type.type', 'Técnico');
        $psychEval = $student->evaluations->where('test.type.type', 'Psicotécnico');

        $techScores = [];
        $psychScores = [];

        foreach (['Inicial', 'Intermédio', 'Final'] as $moment) {
            $techMomentEval = $techEval->where('test.moment', $moment)->first();
            $psychMomentEval = $psychEval->where('test.moment', $moment)->first();
            if ($techMomentEval && $techMomentEval->score !== null && $psychMomentEval && $psychMomentEval->score !== null) {
                $techScores[] = $techMomentEval->score;
                $psychScores[] = $psychMomentEval->score;
            }
            $techStudent[$moment] = $techMomentEval ? $techMomentEval->score : null;
            $psychStudent[$moment] = $psychMomentEval ? $psychMomentEval->score : null;
        }

        !empty($techScores) ?
            $techAverage = array_sum($techScores) / count($techScores)
            :
            $techAverage = null;

        !empty($psychScores) ?
            $psychAverage = array_sum($psychScores) / count($psychScores)
            :
            $psychAverage = null;

        $techStudent['Todos'] = $techAverage;

        $psychStudent['Todos'] = $psychAverage;

        return [$techStudent, $psychStudent];
    }

    public static function boot(){
        parent::boot();

        self::deleting(function (Student $student) {

            $student->evaluations()->delete();
        });
    }
}
