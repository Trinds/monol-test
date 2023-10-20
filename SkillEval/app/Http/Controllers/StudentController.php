<?php

namespace App\Http\Controllers;

use Exception;
use App\Student;
use App\Classroom;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

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
            'classrooms' => Classroom::all()->sortBy('course_id')
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
        $customMessages = [
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before' => 'A data de nascimento não pode ser superior à data atual.',
        ];
        $request->validate([
            'student_number' => 'required|string|max:255|unique:students',
            'classroom_id' => 'required|integer',
            'email' => 'required|email|max:255|unique:students',
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date|before_or_equal:today',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ], $customMessages);
    
        try {
            $imagePath = null;
            if ($request->hasFile('image'))
            {
                $imagePath = $request->file('image')->store('public/images');
                $imagePath = str_replace('public/', '', $imagePath);
            }
            $student = new Student([
                'student_number' => $request->input('student_number'),
                'classroom_id' => $request->input('classroom_id'),
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'birth_date' => $request->input('birth_date'),
                'image' => $imagePath,
            ]);
    
            $student->save();
    
            return redirect()->route('students.index')->with('success', 'Aluno criado com sucesso!');
        } catch (Exception $e) {
        
            return redirect()->route('students.create')->withErrors($e->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Student $student)
    {
        $courses=\App\Course::all();
        $classrooms=\App\Classroom::all();
        return view('students.show',['student'=>$student, 'classrooms'=>$classrooms, 'courses'=>$courses]);
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
        $customMessages = [
            'classroom_id.required' => 'A edição da turma é obrigatória.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before' => 'A data de nascimento não pode ser superior à data atual.',
        ];
        $request->validate(
            [
                'student_number' => 'required|string|max:255',
                'classroom_id' => 'required|integer',
                'email' => 'required|email|max:255|unique:students,email,' . $student->id,
                'name' => 'required|string|max:255',
                'birth_date' => 'required|date|before_or_equal:today',
                'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ], 
        $customMessages);
        $classrooms = \App\Classroom::all();
        $courses = \App\Course::all();
        try {
            $student->update($request->all());
            return redirect()
                ->route('students.show', $student)
                ->with('classrooms', $classrooms)
                ->with('courses', $courses)
                ->with('success', 'Aluno atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->route('students.show', $student)
                ->with('classrooms', $classrooms)
                ->with('courses', $courses)
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
          try {
                $student->delete();
                return redirect()->route('students.index')->with('success', 'Aluno eliminado com sucesso!');
          } catch (Exception $e) {
                return redirect()->route('students.index')->with('error', 'Erro ao eliminar o aluno. Por favor, tente novamente.');
          }
    }

    public function import(Request $request, Classroom $classroom)
    {
        $this->validate($request,[
            'file' => ['required','file','mimes:xlsx,xls']
        ]);
        try{
            Excel::import(new StudentsImport($classroom), $request->file('file'));
        }
        catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            $failures = $e->failures();
            foreach($failures as $failure){
                $failure->row();
                $failure->attribute();
                $failure->errors();
                $failure->values();
            }
            return view('classrooms.show', ['classroom' => $classroom, 'failures'=>$failures]);
        }
        return redirect()->route('classrooms.show', $classroom)->with('success','Formandos importados com sucesso!');
    }
}
