<?php

namespace App\Http\Controllers;

use App\Student;
use App\Test;
use App\Classroom;
use App\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createForStudent(Student $student)
    {
      
        $tests = Test::all();

        return view('evaluations.create-for-student', 
            compact('student', 'tests'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function storeForStudent(Request $request, Student $student)
{
    $request->validate([
        'test_id' => 'required',
        'score' => 'required|numeric|min:0|max:20'
    ]);

    $evaluation = new Evaluation([
        'test_id' => $request->input('test_id'),
        'score' => $request->input('score'),
        'student_id' => $request->input('student_id')
    ]);

    $evaluation->save();

    $student = Student::findOrFail($request->input('student_id'));


    return redirect()->route('students.show', ['student' => $student->id]);


}

     


    /**
     * Display the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
