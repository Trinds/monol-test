<?php

namespace App\Http\Controllers;

use App\Test;
use App\Course;
use App\Student;
use App\Classroom;
use App\Evaluation;
use Exception;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::all();
        $classrooms = Classroom::all();
        // If a course is selected, filter classrooms based on the selected course
        if ($request->has('course_id')) 
        {
            $selectedCourseId = $request->input('course_id');
            $classrooms = Classroom::where('course_id', $selectedCourseId)->get();
        }
    
        return view('evaluations.index', [
            'courses' => $courses,
            'classrooms' => $classrooms,
            'students' => Student::all()->sortBy('student_name'),
        ]);
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

        return view(
            'evaluations.create-for-student',
            compact('student', 'tests')
        );
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeForStudent(Request $request, Student $student)
    {
        try {
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

            return redirect()->route('students.show', ['student' => $student->id])->with('success', 'Avaliação criada com sucesso!');

        } catch (Exception $e) {
            return redirect()->route('students.show', ['student' => $student->id])->with('error', 'Falha ao criar a avaliação. Por favor, tente novamente.');
        }
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
