<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // Initialize the query
        $query = Classroom::query();
    
        // Start date filter
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->input('start_date'));
        }
    
        // End date filter
        if ($request->filled('end_date')) {
            $query->whereDate('end_date', '<=', $request->input('end_date'));
        }
    
        // Get the filtered records
        $classrooms = $query->get();
    
        // Pass the filtered data to the view
        return view('reports.index', compact('classrooms'));
    }
}
