<link rel="stylesheet" href="{{asset('css/courses.css')}}">
@extends('master.main')



@section('content')

@component('components.users.edit-form', ['user' => $user, 'roles' => $roles] );  

@endcomponent

@endsection