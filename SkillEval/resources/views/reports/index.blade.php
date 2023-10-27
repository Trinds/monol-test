@extends('master.main')

@section('scripts')
    <script src="{{ asset('js/classroomsFilter.js') }}"></script>
@endsection

@section('styles')
    <link href="{{ asset('css/reports.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h1 class="title">Relatório de médias</h1>
    @component('components.reports.report-form', ['courses' => $courses, 'classrooms' => $classrooms])
    @endcomponent
    @component('components.reports.table', ['classrooms' => $classrooms])
    @endcomponent
@endsection
