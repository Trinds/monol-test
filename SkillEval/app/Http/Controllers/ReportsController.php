<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use App\Classroom;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // Initialize an empty student query
        $studentQuery = Student::query();
    
        // Initialize an empty classroom query
        $classroomQuery = Classroom::query();
    
        // Start date filter
        if ($request->filled('start_date')) 
            $classroomQuery->whereDate('start_date', '>=', $request->input('start_date'));
    
        // End date filter
        if ($request->filled('end_date')) 
            $classroomQuery->whereDate('end_date', '<=', $request->input('end_date'));
    
        // Filter by course abbreviation
        if ($request->filled('course_id')) 
        {
            $courseAbbreviation = $request->input('course_id');
            $classroomQuery->whereHas('course', function ($query) use ($courseAbbreviation) 
            {
                $query->where('abbreviation', $courseAbbreviation);
            });
    
            $studentQuery->whereHas('classroom.course', function ($query) use ($courseAbbreviation) 
            {
                $query->where('abbreviation', $courseAbbreviation);
            });
        }
    
        $students = $studentQuery->get();
        $classrooms = $classroomQuery->get();        
        $courses = Course::all();
    
        return view('reports.index', compact('students', 'courses', 'classrooms'));
    }
    
    
}
