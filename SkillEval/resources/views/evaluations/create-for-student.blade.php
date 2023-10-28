@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
@endsection

@section('content')
    <div class="container">
        <h1>Adicionar Avaliação para
            <a href="{{ route('students.show', $student) }}">{{$student->name}}</a>
        </h1>

        <form action="{{ route('evaluations.store.student', $student->id) }}" method="POST" class="create-form">
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
            @csrf
            <label for='moment' class="form-label">Momento:</label>
            <select name="moment" id="moment" class="form-control-select" required>
                @foreach ($tests->unique('moment') as $test)
                    <option value="{{ $test->moment }}">{{ $test->moment }}</option>
                @endforeach
            </select>
            <input class="form-input" required type="hidden" name="student_id" value="{{ $student->id }}">
            <label for="type" class="form-label">Tipo de Avaliação:</label>
            <select name="type" id="type" class="form-control-select" required>
                <option value="">Selecione...</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
            <label for="date" class="form-label">Data:</label>
            <input class="form-input" type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required>
            <label for="grade" class="form-label">Nota:</label>
            <input required type="number" name="score" id="score" min="0" max="20" step="0.1" value="">
            <div class="form-group">
                <button type="submit">Adicionar
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
