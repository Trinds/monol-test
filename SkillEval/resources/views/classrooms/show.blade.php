@extends('master.main')

@section('content')

@component('components.classrooms.show-component', ['classroom' => $classroom, 'failures' => $failures])
    
@endcomponent

@endsection