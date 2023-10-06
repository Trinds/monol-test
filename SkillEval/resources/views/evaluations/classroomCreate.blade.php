@extends('master.main')

@section('content')

<div class="container">
    <h1>Avaliação para a turma {{$classroom->name}}</h1>

    <form method="POST" action="{{ route('evaluations.store', ['classroom' => $classroom]) }}">
        @csrf
        <div class="form-group">
            <label for="test">Teste</label>
            <select name="test_id" id="test" class="form-control">
                @foreach ($tests as $test)
                    <option value="{{ $test->id }}">{{ $test->type->type }}</option>
                @endforeach
            </select>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classroom->students as $student)
                    <tr>
                        <td>{{$student->name}}</td>
                        <td><input type="number" name="score[{{$student->id}}]" id="score" class="form-control"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submeter</button>
    </form>
</div>

@endsection