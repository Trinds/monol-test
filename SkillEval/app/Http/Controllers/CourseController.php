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
                ->paginate(8)->withQueryString()
            :
            $courses = Course::paginate(8)->withQueryString();

        return view('courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:10', 'unique:courses,abbreviation'],
        ]);
        try {
            Course::create($request->all());
            return redirect()->route('courses.index')->with('success', 'Curso criado com sucesso!');
        } catch (Exception $e) {
            return redirect()
            ->route('courses.create')
            ->withErrors($e->getMessage());
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:10', 'unique:courses,abbreviation,'.$course->id],
        ]);
        try
        {
            $course->update($request->all());
            return redirect()->route('courses.index')->with('success','Curso atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('courses.edit', $course->id)->withErrors($e->getMessage());
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
