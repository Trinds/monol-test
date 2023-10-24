@extends('master.main')
@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/editionFilter.js') }}"></script>
@endsection

@section('content')

    @component('components.evaluations.table', 
                [      
                'tests'=>$tests,                   
                'courses'=>$courses, 
                'students' =>$students,
                'classrooms'=>$classrooms,
                ])
    @endcomponent

@endsection
