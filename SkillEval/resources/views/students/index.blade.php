@extends('master.main')

    @section('styles')
    <link rel="stylesheet" href="{{asset('css/students.css')}}">
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')

    @component('components.topbar',[
    'dir'=>route('students.create'),
    'createBtnName'=>'Aluno','classrooms'=>$classrooms,
    'formAction'=>'/students'
     ])
    @endcomponent


    @component('components.students.students-table', ['students' => $students] )
    @endcomponent

@endsection
