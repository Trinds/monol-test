@extends('master.main')

@section('scripts')
    <script src="{{asset('js/confirmationBox.js')}}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/classrooms.css')}}">
@endsection

@section('content')

    @component('components.topbar',[
    'dir'           => 'classrooms',
    'createBtnName' => 'Turma',
    'courses'       => $courses,
    'filterName'    => 'Curso'
    ])
    @endcomponent

    @component('components.classrooms.table', ['classrooms' => $classrooms])
    @endcomponent

@endsection
