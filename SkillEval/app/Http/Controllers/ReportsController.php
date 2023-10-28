<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Course;
use App\Student;
use App\Classroom;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        $classrooms = Classroom::all();

        if ( $request->input('course_id') && $request->input('course_id') !== "" ){
            $classroomQuery = Classroom::query();

            if ($request->filled('start_date')) {
                $classroomQuery->whereDate('start_date', '>=', $request->input('start_date'));
            }

            if ($request->filled('end_date')) {
                $classroomQuery->whereDate('end_date', '<=', $request->input('end_date'));
            }

            if ( $request->input('classroom_edition') == "" )
                $classroomQuery->whereHas('course', function ($query) use ($request){
                    $query->where('abbreviation', $request->input('course_id'));
                });

            $classrooms = $classroomQuery->get();
        }
        return view('reports.index', compact('courses', 'classrooms'));
    }
}
