<link rel="stylesheet" href="{{asset('css/courses.css')}}">
@extends('master.main')

@section('content')

@component('components.courses.edit-form', ['course' => $course])
    
@endcomponent



@endsection
