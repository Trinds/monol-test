@extends('master.main')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>--}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/classrooms.css')}}">
@endsection

@section('content')

    @component('components.classrooms.show-component', ['classroom' => $classroom, 'failures' => $failures])

    @endcomponent

@endsection
