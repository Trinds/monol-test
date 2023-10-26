<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public $incrementing=false;

    protected $primaryKey = ['student_id', 'test_id'];

    protected $fillable = [
        'student_id',
        'test_id',
        'score',
        'date',
    ];
    public function test()
    {
        return $this->belongsTo('App\Test');
    }

    public function student()
    {
        return $this->belongsTo('App\User');
    }
}
