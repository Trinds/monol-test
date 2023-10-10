@extends('master.main') 

@section('content')

<h1>Adicionar Avaliação para 
    <a href="{{ route('students.show', $student) }}">{{$student->name}}</a>
</h1>

<form action="{{ route('evaluations.store.student', $student) }}" method="POST">

    @csrf
    <label for="test_id">Avaliação</label>
    <input type="hidden" name="student_id" value="{{ $student->id }}">
    <select class="form-control" id="test_id" name="test_id">
        @foreach ($tests as $test)
            <option value={{$test->id}} {{old('test_id')}}>{{$test->type->type}}</option>
        @endforeach
    </select>
    <label for="score">Nota</label>
    <input type="number" name="score" class="form-control" min="0" max="20" step="0.1">
    <button type="submit" class="btn btn-primary">Submeter</button>
</form>

@endsection
