<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

    protected $fillable = [
        'type_id',    
        'description',      
    ];
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }   
}