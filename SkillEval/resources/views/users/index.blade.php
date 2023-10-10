@extends('master.main')

    @section('styles')
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')


    @component('components.users.users-table', ['users' => $users] )
    @endcomponent

@endsection
