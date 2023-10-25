<?php

namespace App\Http\Controllers;

use App\Test;
use App\Course;
use App\Student;
use App\Classroom;
use App\Evaluation;
use App\Type;
use Exception;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $test_types = Type::all();
        $tests = Test::all();
        $courses = Course::all();
        $students = Student::all();
        $classrooms = Classroom::all();
        // If a course is selected, filter classrooms based on the selected course
        if ($request->has('course_filter')) {
            $classrooms = Classroom::where('course_id', $request->input('course_filter'))->get();
        }
        // If a classrom is selected, filter students based on the selected classroom
        if ($request->has('classroom_filter')) {
            $students = Student::where('classroom_id', $request->input('classroom_filter'))->get();
        } else
            $students = [];

        return view('evaluations.index',
            [
                'test_types' => $test_types,
                'tests' => $tests,
                'courses' => $courses,
                'students' => $students,
                'classrooms' => $classrooms,
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

    public function store(Request $request)
    {
        $test_id = $request->input('test_id');
        $momentId = request('moment_id');
        $grades = json_decode(request('grades'));
        $student = request('students');

        dd($grades);
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
     * @param \Illuminate\Http\Request $request
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
     * @param \App\Evaluation $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Evaluation $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Evaluation $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Evaluation $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
