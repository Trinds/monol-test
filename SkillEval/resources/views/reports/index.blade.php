@extends('master.main')

@section('styles')
    <link href="{{ asset('css/reports.css') }}" rel="stylesheet">
@endsection

@section('content')
    @component('components.reports.report-form', ['classEditions' => $classEditions, 'courses' => $courses])
    @endcomponent
    @component('components.reports.table', ['students' => $students, 'classrooms' => $classrooms])
    @endcomponent
@endsection
