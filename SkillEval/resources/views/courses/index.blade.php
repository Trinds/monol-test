@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/courses.css')}}">
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')

    @component('components.topbar',[
    'dir'=>'courses',
    'createBtnName'=>'Curso',
    ])
    @endcomponent

    @component('components.courses.table', ['courses' => $courses] )

    @endcomponent



@endsection
