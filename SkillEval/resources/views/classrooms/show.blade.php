@extends('master.main')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/3.0.1/chartjs-plugin-annotation.min.js"></script>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/classrooms.css')}}">
@endsection

@section('content')

    @component('components.classrooms.show-component', [
    'classroom' => $classroom,
    'failures' => $failures,
    'classTechEval' => $classTechEval,
    'classPsychoEval' => $classPsychoEval,
    'techAvg' => $techAvg,
    'psychAvg' => $psychAvg
    ])

    @endcomponent

@endsection
