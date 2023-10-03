@extends('master.main')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/students.css')}}">
@endsection

@section('content')

    @component('components.students.students-table', ['students' => $students] )

    @endcomponent

@endsection
