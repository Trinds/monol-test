<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Course;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',
            [
                'coursesCount'     => Course::all()->count(),
                'classroomsCount'  => Classroom::all()->count(),
                'studentsCount'    => Student::all()->count(),
                'usersCount'       => User::all()->count()
            ]);
    }
}
