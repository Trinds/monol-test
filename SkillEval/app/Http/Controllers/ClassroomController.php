<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Course;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClassroomImport;
use mysql_xdevapi\Collection;

class ClassroomController extends Controller
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
            'filter' => 'nullable|integer|exists:courses,id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('classrooms.index')->withErrors($validator)->withInput();
        }
        $classrooms = Classroom::paginate(14)->withQueryString();
        if (isset($request->searchParam) && isset($request->filter) && $request->filter != "") {
            $classrooms = Classroom::query()
                ->select(['*'])
                ->whereHas('course', function ($query) use ($request) {
                    $query->where('classrooms.edition', 'LIKE', '%' . strtolower($request->searchParam) . '%')
                        ->orWhere('courses.abbreviation', 'LIKE', '%' . strtolower($request->searchParam) . '%');
                })->where('classrooms.course_id', $request->filter)
                ->paginate(14)->withQueryString();
        } else if (isset($request->filter) && $request->filter != "") {
            $classrooms = Classroom::query()
                ->where('classrooms.course_id', $request->filter)
                ->paginate(14)->withQueryString();
        } else if (isset($request->searchParam)) {
            $classrooms = Classroom::query()
                ->select(['*'])
                ->whereHas('course', function ($query) use ($request) {
                    $query->where('classrooms.edition', 'LIKE', '%' . strtolower($request->searchParam) . '%')
                        ->orWhere('courses.abbreviation', 'LIKE', '%' . strtolower($request->searchParam) . '%');
                })->paginate(14)->withQueryString();
        }

        return view('classrooms.index', [
            'classrooms' => $classrooms,
            'courses' => Course::all()->sortBy('name')
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
        $failures = null;
        if ($courses->isEmpty()) {
            return redirect()->route('courses.create')->with('error', 'Não existem cursos para adicionar turmas! Por favor, adicione um curso primeiro.');
        }
        return view('classrooms.create', ['courses' => $courses, 'failures' => $failures]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'edition' => [
                'required', 'string', 'max:255', 'regex:/^(0[1-9]|1[0-2])\.(0[1-9]|[1-9][0-9])$/',
                function ($attribute, $value, $fail) use ($request) {
                    $existingClassroom = Classroom::where('edition', $value)
                        ->where('course_id', $request->input('course_id'))
                        ->whereNull('deleted_at')
                        ->first();
                    if ($existingClassroom) {
                        $fail('Já existe uma turma com a mesma edição e curso selecionado.');
                    }
                }
            ],
            'course_id' => ['required', 'integer'],
            'start_date' => ['required', 'date', 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);
        try {
            Classroom::create($request->all());
            return redirect()->route('classrooms.index')->with('success', 'Turma criada com sucesso!');
        } catch (\Exception $e) {
            $failures = $e->getMessage();
            $courses = \App\Course::all();
            return redirect()
                ->route('classrooms.create')
                ->with('failures', $failures)
                ->with('courses', $courses);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Classroom $classroom
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Classroom $classroom)
    {
        list($classTechEval, $classPsychoEval, $techAvg, $psychAvg) = $classroom->getStudentsEvaluations($classroom);
        list($techAvg, $psychAvg) = $classroom->calculateClassAvgs($techAvg, $psychAvg);

        $failures = null;
        return view('classrooms.show', [
            'classroom' => $classroom,
            'failures' => $failures,
            'classTechEval' => $classTechEval,
            'classPsychoEval' => $classPsychoEval,
            'techAvg' => $techAvg,
            'psychAvg' => $psychAvg
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Classroom $classroom
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Classroom $classroom)
    {
        $courses = \App\Course::all();
        return view('classrooms.edit', ['classroom' => $classroom, 'courses' => $courses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Classroom $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Classroom $classroom)
    {
        $this->validate($request, [
            'edition' => [
                'required', 'string', 'max:255', 'regex:/^(0[1-9]|1[0-2])\.(0[1-9]|[1-9][0-9])$/',
                function ($attribute, $value, $fail) use ($request, $classroom) {
                    $existingClassroom = Classroom::where('edition', $value)
                        ->where('course_id', $request->input('course_id'))
                        ->first();
                    if ($existingClassroom && $existingClassroom->id != $classroom->id) {
                        $fail('Já existe uma turma com a mesma edição e curso selecionado.');
                    }
                }
            ],
            'course_id' => ['required', 'integer'],
            'start_date' => ['required', 'date', 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);
        try {
            $classroom->update($request->all());
            return redirect()->route('classrooms.index')->with('success', 'Turma atualizada com sucesso!');
        } catch (\Exception $e) {
            $failures = $e->getMessage();
            $courses = \App\Course::all();
            return redirect()
                ->route('classrooms.edit', $classroom->id)
                ->with('failures', $failures)
                ->with('courses', $courses);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Classroom $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Classroom $classroom)
    {
        try {
            $classroom->delete();
        } catch (\Exception $e) {
            return redirect()->route('classrooms.index')->with('error', 'Não foi possível excluir a turma! Tente novamente mais tarde.');
        }
        return redirect()->route('classrooms.index')->with('success', 'Turma excluída com sucesso!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls']
        ]);
        try {
            Excel::import(new ClassroomImport, $request->file('file'));
            $lastClassroom = Classroom::latest()->first();
            $failures = null;
            return redirect()
                ->route('classrooms.show', $lastClassroom->id)
                ->with('failures', $failures)
                ->with('success', 'Turma e formandos importados com sucesso!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $courses = Course::all();
            if (session()->has('error')) {
                $failures = null;
                $error = session('error');
                return redirect()->route('classrooms.create')->with('error', $error)->with('failures', $failures)->with('courses', $courses);
            }
            foreach ($failures as $failure) {
                $failure->row();
                $failure->attribute();
                $failure->errors();
                $failure->values();
            }
            return view('classrooms.create', ['courses' => $courses, 'failures' => $failures]);
        }
    }
}
