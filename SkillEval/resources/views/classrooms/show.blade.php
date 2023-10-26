@extends('master.main')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/classrooms.css')}}">
@endsection

@section('content')

    @component('components.classrooms.show-component', ['classroom' => $classroom, 'failures' => $failures, 'classTechEval' => $classTechEval, 'classPsychoEval' => $classPsychoEval])

    @endcomponent

@endsection
