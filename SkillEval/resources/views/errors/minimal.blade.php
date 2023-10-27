
@extends('master.main')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/errors.css')}}">
@endsection
@section('content')
        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
        </div>
    <div class="flex-center position-ref full-height">
        <div class="go-back">
            <button>Voltar</button>
        </div>
    </div>
@endsection
