@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')

    @component('components.topbar',[
    'dir'           => 'classrooms',
    'createBtnName' => 'Turma',
    'courses'       => $courses,
    'filterName'    => 'Curso'
    ])
    @endcomponent

    @component('components.classrooms.table', ['classrooms' => $classrooms, 'hasResults' => $hasResults])
    @endcomponent

@endsection
