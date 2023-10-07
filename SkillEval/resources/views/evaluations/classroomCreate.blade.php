@extends('master.main')

@section('content')

<div class="container">
    <h1>Avaliação para a turma {{$classroom->name}}</h1>

    <form method="POST" action="{{ route('evaluations.store', ['classroom' => $classroom]) }}">
        @csrf
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
                        <td>
                            <input type="number" name="evaluations[{{$student->id}}][test_ids][]" class="form-control" min="0" max="20" step="0.1">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submeter</button>
    </form>
</div>

@endsection
