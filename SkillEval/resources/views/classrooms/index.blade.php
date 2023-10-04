@extends('master.main')

@section('content')

@component('components.classrooms.table', ['classrooms' => $classrooms])
    
@endcomponent

@endsection