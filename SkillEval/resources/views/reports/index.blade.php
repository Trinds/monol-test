@extends('master.main')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    @component('components.reports.table', ['classrooms' => $classrooms, 'courses' => $courses])
    @endcomponent
@endsection
