@extends('master.main')

@section('content')

    @component('components.courses.show-component', ['course' => $course])

    @endcomponent

@endsection
