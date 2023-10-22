@extends('master.main')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    @component('components.reports.table', ['classEditions'=>$classEditions,
                                            'classrooms' => $classrooms, 
                                            'courses' => $courses,
                                            'students' => $students])
    @endcomponent
@endsection
