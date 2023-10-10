<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Course;
use Illuminate\Http\Request;
class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        isset($request->filter) || isset($request->searchParam)
            ? $classrooms = Classroom::query()
            ->join('courses', 'courses.id', '=', 'classrooms.course_id')
            ->where(function ($query) use ($request) {
                $query->where('classrooms.edition', 'LIKE', '%' . strtolower($request->searchParam) . '%')
                    ->orWhere('courses.abbreviation', 'LIKE', '%' . strtolower($request->searchParam) . '%');
            })
            ->where('classrooms.course_id', $request->filter)
            ->get()
            :
            $classrooms = Classroom::all();

        return view('classrooms.index', [
            'classrooms'=>$classrooms,
            'courses'=>Course::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = \App\Course::all();
        return view('classrooms.create', ['courses'=>$courses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'edition' => ['required','string','max:255'],
            'course_id' => ['required','integer'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],
        ]);

        Classroom::create($request->all());
        return redirect()->route('classrooms.index')->with('success','Turma criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {

            return view('classrooms.show', ['classroom'=>$classroom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {

            $courses = \App\Course::all();
            return view('classrooms.edit', ['classroom'=>$classroom, 'courses'=>$courses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {

            $this->validate($request,[
                'edition' => ['required','string','max:255'],
                'course_id' => ['required','integer'],
                'start_date' => ['required','date'],
                'end_date' => ['required','date'],
            ]);

            $classroom->update($request->all());
            return redirect()->route('classrooms.index')->with('success','Turma atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
                $classroom->delete();
                return redirect()->route('classrooms.index')->with('success','Turma excluída com sucesso!');
    }
}
