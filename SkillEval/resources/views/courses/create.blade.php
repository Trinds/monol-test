@extends('master.main')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
@endsection

@section('content')

    @component('components.courses.add-form')

    @endcomponent

@endsection
