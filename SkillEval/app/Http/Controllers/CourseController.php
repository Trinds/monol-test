<?php

namespace App\Http\Controllers;

use Exception;
use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        isset($request->searchParam) ?
            $courses = Course::query()
            ->where(strtoupper('abbreviation'), 'LIKE', '%' . strtoupper($request->searchParam) . '%')
            ->orWhere(strtoupper('name'), 'LIKE', '%' . strtoupper($request->searchParam) . '%')
            ->get()
            :
            $courses = Course::all();

        return view('courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'abbreviation' => ['required', 'string', 'max:10'],
            ]);
        
            Course::create($request->all());
            return redirect()->route('courses.index')->with('success', 'Curso criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('courses.index')->with('error', 'Falha ao criar o curso. Por favor, tente novamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course = Course::find($course->id);

        return view('courses.show', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit',['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        try
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'abbreviation' => ['required', 'string', 'max:10'],
            ]);
        
            $course->update($request->all());
            return redirect()->route('courses.index')->with('success','Curso atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('courses.index')->with('error', 'Falha ao atualizar o curso. Por favor, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
            $course->delete();
            return redirect()->route('courses.index')->with('success','Curso apagado com sucesso!');
    }
}
