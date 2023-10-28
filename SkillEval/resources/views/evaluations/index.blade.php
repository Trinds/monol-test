@extends('master.main')
@section('styles')
    <link href="{{ asset('css/evaluations.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/classroomsFilter.js') }}"></script>
@endsection

@section('content')
    <h1 class="title">Registar Avaliação</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any() || session('error'))
    <div class="alert alert-danger">
        <ul>
            @if (session('error'))
                <li> {{ session('error') }}</li>
            @endif
            <br>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="input-container">
        <form method="get" action="/evaluations">
            <div class="row">
                <div class="col larger-input">
                    <label for="course_id">Curso:</label>
                    <select id="course_id" name="course_filter" class="form-control">
                        <option value="">Selecionar Curso</option>
                        @foreach($courses as $course)
                            <option
                                value="{{ $course->id }}" {{ (old('course_filter', request('course_filter')) == $course->id) ? 'selected' : '' }}>
                                {{ $course->abbreviation }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col larger-input">
                    <label for="classroom_filter">Turma</label>
                    <select id="classroom_id" name="classroom_filter" class="form-control"
                            onchange="this.form.submit()">
                        <option value="" selected>Selecionar Turma</option>
                        @foreach($classrooms as $classroom)
                            <option
                                value="{{ $classroom->id }}"
                                data-course="{{$classroom->course->id}}"
                                {{ (old('classroom_filter', request('classroom_filter')) == $classroom->id) ? 'selected' : '' }} >
                                {{ $classroom->edition }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </form>
        @if($students)
            <form method="POST" action="{{ route('evaluations.store') }}">
                @csrf
                <div class="row">
                    <div class="col smaller-input">
                        <label for="type">Teste:</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">Selecione...</option>
                            @foreach ($test_types as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col smaller-input">
                        <label for="moment">Momento:</label>
                        <select name="moment" id="moment" class="form-control" required>
                            <option value="">Selecione...</option>
                            @foreach ($tests->unique('moment') as $test)
                                <option value="{{ $test->moment }}">{{ $test->moment }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col smaller-input">
                        <label for="date">Data:</label>
                        <input type="date" id="date" name="date" class="form-control"
                               value="<?php echo date('Y-m-d'); ?>"
                               required>
                    </div>
                </div>
    </div>

            @component('components.evaluations.table', [ 'students' =>$students])
            @endcomponent
       @endif
@endsection
