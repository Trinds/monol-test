@extends('master.main')

@section('scripts')
    <script src="{{asset('js/confirmationBox.js')}}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
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
