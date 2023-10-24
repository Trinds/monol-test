@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/courses.css')}}">
@endsection

@section('content')

@component('components.users.create-form', ['roles' => $roles] );    

@endcomponent

@endsection 

