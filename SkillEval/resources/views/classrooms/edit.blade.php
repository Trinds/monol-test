@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
@endsection


@section('content')

    @component('components.classrooms.edit-form', ['courses' => $courses , 'classroom' => $classroom])

    @endcomponent

@endsection
