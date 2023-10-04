<link rel="stylesheet" href="{{asset('css/courses.css')}}">
@extends('master.main')

@section('content')

@component('components.classrooms.edit-form', ['courses' => $courses , 'classroom' => $classroom])
    
@endcomponent

@endsection