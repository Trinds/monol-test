@extends('master.main')

@section('styles')
    <link href="{{ asset('css/reports.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h1 class="title">Relatório de médias</h1>
    @component('components.reports.report-form', ['classEditions' => $classEditions, 'courses' => $courses])
    @endcomponent
    @component('components.reports.table', ['students' => $students, 'classrooms' => $classrooms])
    @endcomponent
@endsection
