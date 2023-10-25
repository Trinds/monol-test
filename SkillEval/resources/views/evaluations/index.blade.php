@extends('master.main')
@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/evaluations.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/editionFilter.js') }}"></script>
@endsection

@section('content')

    <h1 class="title">Inserção de Pauta</h1>
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
        <div class="col">
            <label for="test_id">Teste:</label>
            <select name="test_id" id="test_id" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($test_types as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="moment_id">Momento:</label>
            <select name="moment_id" id="moment_id" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($tests as $test)
                    <option value="{{ $test->id }}">{{ $test->moment }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @component('components.evaluations.table', [ 'students' =>$students ])
    @endcomponent

    @if($students)
    <form method="POST" action="{{ url('evaluations') }}">
        @csrf
        <input type="hidden" name="grades" id="grades" value="">
        <div id="insert_button">
            <button type="submit">Inserir Pauta</button>
        </div>
    </form>
    @endif

@endsection
