@extends('master.main')

@section('content')

@component('components.courses.table', ['courses' => $courses] )
    
@endcomponent



@endsection
