<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public function test()
    {
        return $this->belongsTo('App\Test');
    }

    public function student()
    {
        return $this->belongsTo('App\User');
    }
}
