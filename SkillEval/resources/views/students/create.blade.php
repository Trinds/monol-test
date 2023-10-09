<link rel="stylesheet" href="{{asset('css/courses.css')}}">
@extends('master.main')

@section('content')

@component('components.students.add-form', ['courses'=>$courses, 'classrooms'=>$classrooms])
    
@endcomponent

@endsection