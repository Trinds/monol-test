@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
@endsection

@section('content')

    @component('components.users.users-show', ['user' => $user] )
    @endcomponent

@endsection
