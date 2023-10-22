@extends('master.main')

    @section('styles')
    <link rel="stylesheet" href="{{asset('css/students.css')}}">
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')


    @component('components.topbar',[
    'dir'           => 'students',
    'createBtnName' => 'Aluno',
    'classrooms'    => $classrooms,
    'filterName'    => 'Turma'
     ])
    @endcomponent



    @component('components.students.students-table', ['students' => $students, 'hasResults' => $hasResults] )
    @endcomponent

@endsection
