@extends('master.main')

@section('scripts')
    <script src="{{ asset('js/createClassroomForm.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
@endsection

@section('content')

    @component('components.classrooms.add-form', ['courses' => $courses, 'failures' => $failures])

    @endcomponent

@endsection
