<link rel="stylesheet" href="{{asset('css/forms.css')}}">
@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
@endsection

@section('content')
    @component('components.courses.edit-form', ['course' => $course])

    @endcomponent

@endsection
