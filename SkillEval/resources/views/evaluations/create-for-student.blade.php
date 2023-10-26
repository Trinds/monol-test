@extends('master.main') 

@section('content')

<h1>Adicionar Avaliação para 
    <a href="{{ route('students.show', $student) }}">{{$student->name}}</a>
</h1>



<form action="{{ route('evaluations.store.student', $student->id) }}" method="POST">


    @csrf
    <label for="type">Tipo de Avaliação:</label>    
    <select name="type" id="type" class="form-control">
        <option value="">Selecione...</option>
        @foreach ($types as $type)
        <option value="{{ $type->id }}">{{ $type->type }}</option>
        @endforeach
    </select>
    <label for='moment'>
        Momento:
    </label>
    <select name="moment" id="moment" class="form-control">
        <option value="">Selecione...</option>
        @foreach ($tests->unique('moment') as $test)
        <option value="{{ $test->moment }}">{{ $test->moment }}</option>
        @endforeach
    </select>
    <label for="date">Data:</label> 
    <input type="date" name="date" id="date" value="">
    <label for="grade">Nota:</label>
    <input type="number" name="grade" id="grade" min="0" max="20" step="0.1" value="">
    <button type="submit">Adicionar</button>
</form>

@endsection
