@extends('master.main')

    @section('styles')
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')

@component('components.topbar',[
    'dir'=>'users',
    'createBtnName'=>'Utilizador',
    ])
    @endcomponent


    @component('components.users.users-table', ['users' => $users] )
    @endcomponent

@endsection
