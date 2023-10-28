<?php

namespace App\Http\Controllers;


use App\Test;
use App\Type;
use Exception;
use App\Course;
use App\Student;
use App\Classroom;
use App\Evaluation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $classrooms = Classroom::query();
        $students = Student::query();

        if ($request->has('course_filter') && $request->has('classroom_filter')) {
            $classrooms = Classroom::where('course_id', $request->input('course_filter'))->get();
            $students = Student::where('classroom_id', $request->input('classroom_filter'))->get();
        }
        else
            $students = [];

        $classrooms = Classroom::all();
        $test_types = Type::all();
        $tests = Test::all();
        $courses = Course::all();

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
        $selectedTestTypeId = $request->input('type');
        $selectedMoment = $request->input('moment');
        $grades = $request->input('grades');
        $test = Test::where('moment', $selectedMoment)
            ->where('type_id', $selectedTestTypeId)
            ->first();

        if (!$test) {
            return redirect()->route('evaluations.index')->with('error', 'Não existe avaliação para o momento e tipo selecionados.');
        }

        $date = $request->input('date');

        $filteredGrades = array_filter($grades, function ($grade) {
            return $grade !== null && $grade !== '';
        });

        if (count($filteredGrades) === 0) {
            return redirect()->route('evaluations.index')->with('error', 'Não foram introduzidas notas.');
        }   
        $errorStudents = [];


        try {
            foreach ($filteredGrades as $studentId => $grade) {

                $existingEvaluation = Evaluation::where('student_id', $studentId)
                    ->where('test_id', $test->id)
                    ->first();

                if ($existingEvaluation) {
                    $student = Student::find($studentId);
                    $errorStudents[] = $student->name;
                    continue;
                } else {
                $evaluation = new Evaluation([
                    'test_id' => $test->id,
                    'score' => $grade,
                    'student_id' => $studentId,
                    'date' => $date
                ]);
                $evaluation->save();
                }
            }
            $successMessage = 'Avaliações criadas com sucesso!';
            if (!empty($errorStudents)) {
                $error = 'As seguintes avaliações não foram criadas devido a avaliações já existentes para os alunos: ' . implode(', ', $errorStudents);
                return redirect()->route('evaluations.index')->with('error', $error)->with('success', $successMessage);
            }
            return redirect()->route('evaluations.index')->with('success', 'Avaliações criadas com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('evaluations.index')->with('error', 'Ocorreu um erro ao criar as avaliações: ' . $e->getMessage());
        }
    }


    public function createForStudent(Student $student)
    {
        $tests = Test::all();
        $types = Type::all();

        return view(
            'evaluations.create-for-student',
            compact('student', 'tests', 'types')
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function storeForStudent(Request $request, Student $student)
    {
        try {

            $rules = [
                'moment' => 'required',
                'type' => 'required',
                'score' => 'required|numeric|min:0|max:20',
                'date' => 'required|date',
            ];

            $request->validate($rules);


            $testMoment = $request->input('moment');
            $testTypeId = $request->input('type');

            $test = Test::where('moment', $testMoment)
                ->where('type_id', $testTypeId)
                ->first();

            if (!$test) {
                return redirect()->route('evaluations.create-for-student', ['student' => $student->id])
                    ->with('error', 'Não existe avaliação para o momento e tipo selecionados.');
            }

            $testId = $test->id;

            $evaluation = new Evaluation([
                'student_id' => $request->input('student_id'),
                'test_id' => $testId,
                'score' => $request->input('score'),
                'date' => $request->input('date'),
            ]);

            $evaluation->save();

            $student = Student::findOrFail($request->input('student_id'));

            return redirect()->route('students.show', ['student' => $student->id]);
        } catch (\Exception $e) {
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) {
                return redirect()->back()->with('error', 'O formando já tem uma avalição para esse teste.');
            }
            return redirect()->back()->with('error', 'Algo correu mal. Por favor tente novamente.');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($studentId, $testId)
    {
        DB::delete('DELETE FROM evaluations WHERE student_id = ? AND test_id = ?', [$studentId, $testId]);

        return redirect()->route('students.show', ['student' => $studentId])
            ->with('success', 'Avaliação apagada com sucesso.');
    }
}
