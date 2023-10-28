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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'searchParam' => 'nullable|string|max:255',
            'filter' => 'nullable|integer|exists:classrooms,id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('students.index')->withErrors($validator)->withInput();
        }
        $students = Student::paginate(8)->withQueryString();
        if (isset($request->searchParam) && isset($request->filter) && $request->filter != "") {
            $students = Student::query()
                ->where('classroom_id', $request->filter)
                ->where(strtoupper('name'), 'LIKE', '%' . strtoupper($request->searchParam) . '%')
                ->paginate(8)->withQueryString();
        } else if (isset($request->filter) && $request->filter != "") {
            $students = Student::query()
                ->where('classroom_id', $request->filter)->paginate(8)->withQueryString();
        } else if (isset($request->searchParam)) {
            $students = Student::query()
                ->where(strtoupper('name'), 'LIKE', '%' . strtoupper($request->searchParam) . '%')
                ->paginate(8)->withQueryString();
        }

        return view('students.index', [
            'students' => $students,
            'classrooms' => Classroom::all()->sortBy('course_id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        $courses = \App\Course::all();
        $classrooms = \App\Classroom::all();
        if ($courses->isEmpty()) {
            return redirect()->route('courses.create')->with('error', 'Não existem cursos. Por favor, crie um curso primeiro.');
        } elseif ($classrooms->isEmpty()) {
            return redirect()->route('classrooms.create')->with('error', 'Não existem turmas. Por favor, crie uma turma primeiro.');
        }
        return view('students.create', ['courses' => $courses, 'classrooms' => $classrooms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_number' => [
                'required', 'string', 'max:255',
                function ($attribute, $value, $fail) {
                    $existingStudent = Student::where('student_number', $value)
                        ->whereNull('deleted_at')
                        ->first();
                    if ($existingStudent) {
                        $fail('O número de formando introduzido já está em uso.');
                    }
                },
            ],
            'classroom_id' => 'required|integer|exists:classrooms,id',
            'email' => [
                'required', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $existingStudent = Student::where('email', $value)
                        ->whereNull('deleted_at')
                        ->first();
                    if ($existingStudent) {
                        $fail('O email introduzido já está em uso.');
                    }
                },
            ],
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/images');
                $imagePath = str_replace('public/', '', $imagePath);
            }
            $student = new Student([
                'student_number' => $request->input('student_number'),
                'classroom_id' => $request->input('classroom_id'),
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'birth_date' => $request->input('birth_date'),
                'image' => isset($request->image) ? $imagePath : 'images/default/student.png',
            ]);
            $student->save();
            return redirect()->route('students.index')->with('success', 'Formando criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('students.create')->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Student $student)
    {
        $courses = \App\Course::all();
        $classrooms = \App\Classroom::all();
        list($techStudent, $psychStudent) = $student->getStudentScores($student);
        list(, , $techAvg, $psychAvg) = $student->classroom->getStudentsEvaluations($student->classroom);
        list($techAvg, $psychAvg) = $student->classroom->calculateClassAvgs($techAvg, $psychAvg);


        return view('students.show', [
            'student' => $student,
            'classrooms' => $classrooms,
            'courses' => $courses,
            'techScores' => $techStudent,
            'psychScores' => $psychStudent,
            'classTechAvg' => $techAvg,
            'classPsychAvg' => $psychAvg
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Student $student)
    {
        $courses = \App\Course::all();
        $classrooms = \App\Classroom::all();
        return view('students.edit', ['student' => $student, 'courses' => $courses, 'classrooms' => $classrooms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Student $student)
    {
        $request->validate(
            [
                'student_number' => ['required', 'string', 'max:255',
                    function ($attribute, $value, $fail) use ($request, $student) {
                        $existingStudent = Student::where('student_number', $value)
                            ->where('id', '<>', $student->id)
                            ->whereNull('deleted_at')
                            ->first();
                        if ($existingStudent && $existingStudent->id != $student->id) {
                            $fail('O número de formando introduzido já está em uso.');
                        }
                    },
                ],
                'classroom_id' => 'required|integer|exists:classrooms,id',
                'email' => ['required', 'email', 'max:255',
                    function ($attribute, $value, $fail) use ($request, $student) {
                        $existingStudent = Student::where('email', $value)
                            ->where('id', '<>', $student->id)
                            ->whereNull('deleted_at')
                            ->first();
                        if ($existingStudent && $existingStudent->id != $student->id) {
                            $fail('O email introduzido já está em uso.');
                        }
                    },
                ],
                'name' => 'required|string|max:255',
                'birth_date' => 'required|date|before:today',
                'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
                ]
        );
        $classrooms = \App\Classroom::all();
        $courses = \App\Course::all();
        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/images');
                $imagePath = str_replace('public/', '', $imagePath);
            }
            $student->update(
                [
                    'student_number' => $request->input('student_number'),
                    'classroom_id' => $request->input('classroom_id'),
                    'email' => $request->input('email'),
                    'name' => $request->input('name'),
                    'birth_date' => $request->input('birth_date'),
                    'image' => isset($request->image) ? $imagePath : $student->image,
                ]
            );
            return redirect()
                ->route('students.show', $student)
                ->with('classrooms', $classrooms)
                ->with('courses', $courses)
                ->with('success', 'Aluno atualizado com sucesso!');
        } catch (Exception $e) {
            if ($request->is('students/*')) {
                return redirect()
                    ->route('students.show', $student)
                    ->with('classrooms', $classrooms)
                    ->with('courses', $courses)
                    ->withErrors($e->getMessage());
            }
            if ($request->is('students/*/edit')) {
                return redirect()
                    ->route('students.create')
                    ->with('classrooms', $classrooms)
                    ->with('courses', $courses)
                    ->withErrors($e->getMessage());
            }
            return redirect()->back()->with('error', 'Algo correu mal. Por favor tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\RedirectResponse
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
        $this->validate($request, [
            'file' => ['required', 'file', 'mimes:xlsx,xls']
        ]);
        try {
            Excel::import(new StudentsImport($classroom), $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $failure->row();
                $failure->attribute();
                $failure->errors();
                $failure->values();
            }
            return view('classrooms.show', ['classroom' => $classroom, 'failures' => $failures]);
        }
        return redirect()->route('classrooms.show', $classroom)->with('success', 'Formandos importados com sucesso!');
    }
}
