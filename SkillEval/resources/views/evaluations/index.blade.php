@extends('master.main')
@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/evaluations.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/editionFilter.js') }}"></script>
@endsection

@section('content')

    <h1 class="title">Registar Avaliação</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="errors-list">
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="input-container">
        <div class="col">
            <label for="course_filter">Curso:</label>
            <select name="course_filter" id="course_filter" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_filter') == $course->id ? 'selected' : '' }} >{{ $course->abbreviation }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <form method="get" action="/evaluations">
                <label for="classroom_filter">Turma</label>
                <select class="form-control" id="classroom_filter" name="classroom_filter" onchange="this.form.submit()">
                    <option value="">Selecione...</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}"
                                {{ request('classroom_filter') == $classroom->id ? 'selected' : '' }}
                                data-course="{{ $classroom->course_id }}">
                            {{ $classroom->edition }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
<form method="POST" action="{{ route('evaluations.store') }}">
    @csrf
        <div class="col">
            <label for="type">Teste:</label>
            <select name="type" id="type" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($test_types as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="moment">Momento:</label>
            <select name="moment" id="moment" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($tests->unique('moment') as $test)
                    <option value="{{ $test->moment }}">{{ $test->moment }}</option>
                @endforeach
            </select>
        </div>
            <div class="col">
                <label for="date">Data:</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>
    </div>
    @if($students)
        @component('components.evaluations.table', [ 'students' =>$students])
        @endcomponent
    @endif
@endsection
