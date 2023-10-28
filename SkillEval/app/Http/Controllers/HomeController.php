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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',
            [
                'coursesCount' => Course::all()->count(),
                'studentsCount' => Student::all()->count(),
                'usersCount' => User::all()->count(),
                'classrooms' => Classroom::with('course')->get(),
                'courses' => Course::all()
            ]);
    }
}
