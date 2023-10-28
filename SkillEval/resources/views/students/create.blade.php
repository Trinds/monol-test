@extends('master.main')

@section('scripts')
    <script type="module" src="{{ asset('js/classroomsFilter.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
@endsection

@section('content')

    @component('components.students.add-form', ['courses'=>$courses, 'classrooms'=>$classrooms])

    @endcomponent

@endsection
