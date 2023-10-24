
@extends('master.main')

    @section('scripts')
        <script type="module" src="{{ asset('js/classroomsFilter.js') }}"></script>
    @endsection

    @section('styles')
        <link rel="stylesheet" href="{{asset('css/students.css')}}">
    @endsection

    @section('content')
        @component('components.evaluations.table', ['students' => $students, 'classrooms' => $classrooms ,'courses' => $courses] )
    @endcomponent
@endsection