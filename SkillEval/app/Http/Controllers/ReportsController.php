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
        $studentQuery = Student::query();
        $classroomQuery = Classroom::query();

        // Start date filter
        if ($request->filled('start_date')) {
            $classroomQuery->whereDate('start_date', '>=', $request->input('start_date'));
        }

        // End date filter
        if ($request->filled('end_date')) {
            $classroomQuery->whereDate('end_date', '<=', $request->input('end_date'));
        }

        // Other filters (active_classes, course_id) remain unchanged...

        // Retrieve the editions of filtered classrooms
        $selectedCourse = $request->input('course_id');
        $classroomIds = Classroom::whereHas('course', function ($query) use ($selectedCourse) {
            $query->where('abbreviation', $selectedCourse);
        })->pluck('id');

        // Create a new query for classEditions
        $classEditionsQuery = Classroom::whereIn('id', $classroomIds);

        // Start date filter for classEditions
        if ($request->filled('start_date')) {
            $classEditionsQuery->whereDate('start_date', '>=', $request->input('start_date'));
        }

        // End date filter for classEditions
        if ($request->filled('end_date')) {
            $classEditionsQuery->whereDate('end_date', '<=', $request->input('end_date'));
        }

        // Retrieve the class editions
        $classEditions = $classEditionsQuery->pluck('edition');

        $students = $studentQuery->get();
        $classrooms = $classroomQuery->get();
        $courses = Course::all();




        

        $selectedClassEdition = $request->input('classroom_edition');

        if ($selectedClassEdition !== null && $selectedClassEdition !== '') 
        {
            $classroom = Classroom::where('edition', $selectedClassEdition)->first();
        
            if ($classroom) 
                $selectedClassroomID = $classroom->id;
            else 
                $selectedClassroomID = 0; 
            
        } 
        else 
            $selectedClassroomID = -1; 
        

        $classrooms = $classroomQuery->get();
        $courses = Course::all();

        
        $studentQuery = Student::query();
        if ($selectedClassroomID) 
            $students = $studentQuery->where('classroom_id', $selectedClassroomID)->get();
        else 
            $students = [];


        return view('reports.index', compact('students', 'courses', 'classrooms', 'classEditions'));
    }
}
