@extends('master.main')

@section('scripts')
    <script src="{{asset('js/confirmationBox.js')}}"></script>
@endsection

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

    @component('components.students.students-table', ['students' => $students] )
    @endcomponent

@endsection
