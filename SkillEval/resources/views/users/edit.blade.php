
@extends('master.main')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/courses.css')}}">
@endsection


@section('content')

@component('components.users.edit-form', ['user' => $user, 'roles' => $roles] );  

@endcomponent

@endsection