<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Student;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $students = Student::all();

        if ( isset($request->filter) && $request->filter != "" ){
            if ( isset($request->searchParam) ){
                $students = Student::query()
                    ->where('classroom_id',$request->filter)
                    ->where(strtoupper('name'), 'LIKE', '%' . strtoupper($request->searchParam) . '%')
                    ->get();
            }
            else{
                $students = Student::query()
                    ->where('classroom_id',$request->filter)->get();
            }
        }
        else{
            if ( isset($request->searchParam) ){
                $students = Student::query()
                    ->where(strtoupper('name'), 'LIKE', '%' . strtoupper($request->searchParam) . '%')
                    ->get();
            }
        }

        return view('students.index', [
            'students' => $students,
            'classrooms' => Classroom::all()->sortBy('name')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $courses=\App\Course::all();
        $classrooms=\App\Classroom::all();
        return view('students.create', ['courses'=>$courses, 'classrooms'=>$classrooms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'student_number' => ['required','string','max:255'],
            'classroom_id' => ['required','integer'],
            'email' => ['required','email','max:255'],
            'name' => ['required','string','max:255'],
            'birth_date' => ['required','date', function($atribute, $value, $fail){
                if($value > now())
                    $fail('A data de nascimento não pode ser superior à data atual.');
            }],
            'image' => ['nullable','image','max:2048']
        ]);
        Student::create($request->all());
        return redirect()->route('students.index')->with('success','Estudante criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Student $student)
    {
        return view('students.show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
