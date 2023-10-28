@extends('master.main')

@section('scripts')
    <script src="{{asset('js/confirmationBox.js')}}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
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
