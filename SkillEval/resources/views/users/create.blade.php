<link rel="stylesheet" href="{{asset('css/courses.css')}}">
@extends('master.main')

@section('content')

@component('components.users.create-form', ['roles' => $roles] );    

@endcomponent

@endsection 

