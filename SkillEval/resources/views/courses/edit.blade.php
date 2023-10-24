<link rel="stylesheet" href="{{asset('css/courses.css')}}">
@extends('master.main')

@section('content')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/courses.css')}}">
@endsection

@component('components.courses.edit-form', ['course' => $course])
    
@endcomponent



@endsection
