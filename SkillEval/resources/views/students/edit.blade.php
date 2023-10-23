@extends('master.main')

@section('scripts')
    <script type="module" src="{{ asset('js/classroomsFilter.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/courses.css')}}">
@endsection

@section('content')

    @component('components.students.edit-form', ['student'=>$student ,'courses'=>$courses, 'classrooms'=>$classrooms])

    @endcomponent

@endsection
