
@extends('master.main')

    @section('scripts')
        <script type="module" src="{{ asset('js/classroomsFilter.js') }}"></script>
    @endsection



    @section('content')
        @component('components.evaluations.table', 
        [
            'hasResults' => $hasResults,
            'classrooms' => $classrooms ,
            'courses' => $courses
        ] )
    @endcomponent
@endsection