@extends('master.main')

@section('styles')
{{--    <link rel="stylesheet" href="{{asset('css/courses.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')

    @component('components.topbar',[
    'dir'=>route('courses.create'),
    'createBtnName'=>'Curso',
    'formAction'=>'/courses'
    ])
    @endcomponent

    @component('components.courses.table', ['courses' => $courses] )

    @endcomponent



@endsection
