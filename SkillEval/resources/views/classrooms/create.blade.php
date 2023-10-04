<link rel="stylesheet" href="{{asset('css/courses.css')}}">
@extends('master.main')

@section('content')

@component('components.classrooms.add-form', ['courses' => $courses])
    
@endcomponent

@endsection