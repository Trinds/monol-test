@extends('master.main')
@section('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="{{asset('css/user-card.css')}}">
@section('content')
@component('components.users.users-show', ['user' => $user] )   

@endcomponent
@endsection 
