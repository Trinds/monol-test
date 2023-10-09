@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')

    @component('components.topbar',['dir'=>route('classrooms.create'), 'createBtnName'=>'Turma'])
    @endcomponent

    @component('components.classrooms.table', ['classrooms' => $classrooms])
    @endcomponent

@endsection
