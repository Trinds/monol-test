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
        $query = Classroom::query();
        
        // Start date filter
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->input('start_date'));
        }
        
        // End date filter
        if ($request->filled('end_date')) {
            $query->whereDate('end_date', '<=', $request->input('end_date'));
        }
        
        $classrooms = $query->get();        
        $courses = Course::all();        
        $students = Student::all(); 

        
        return view('reports.index', compact('classrooms','courses','students'));
    }
}

