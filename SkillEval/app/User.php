<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\HasRoles;



class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable =
    [
        'name', 'email', 'password', 'image'
    ];

    protected $hidden =
    [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
