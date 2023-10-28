@extends('master.main')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/errors.css')}}">
@endsection
@section('content')
    <div class="flex-center position-ref full-height flex-column">
        <div class="flex-center">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
        </div>
        <div class="flex-center go-back p-3">
            <a href="{{ url('home') }}">
                <button>Início</button>
            </a>
        </div>
    </div>
@endsection
