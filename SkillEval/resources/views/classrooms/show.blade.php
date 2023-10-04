@extends('master.main')

@section('content')

@component('components.classrooms.show-component', ['classroom' => $classroom])
    
@endcomponent

@endsection