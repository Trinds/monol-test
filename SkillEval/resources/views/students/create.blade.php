@extends('master.main')

@section('scripts')
    <script src="{{ asset('js/createStudentForm.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/courses.css')}}">
@endsection

@section('content')

    @component('components.students.add-form', ['courses'=>$courses, 'classrooms'=>$classrooms])

    @endcomponent

@endsection
