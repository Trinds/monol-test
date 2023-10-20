@extends('master.main')

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script type="module" src="{{asset('js/createStudentChart.js')}}"></script>
<script type="module" src="{{asset('js/createStudentForm.js')}}"></script>
<script type="module" src="{{asset('js/editStudentCard.js')}}"></script>
@endsection

@section('content')

<div class="title">
    <h1>Detalhes do Aluno</h1>
</div>

<div class="add-evaluation">
    <a href="{{ route('evaluations.create.student', $student->id) }}">Adicionar Avaliação<i class="fa-solid fa-plus-circle addBtn"></i></a>
</div>

<div class="grid-container">
    <div class="chart-container">
        @component('components.students.evaluations-chart' , ['studentEvaluations'=>$student->evaluations])
        @endcomponent
    </div>

    <div class="details-container">
        @component('components.students.student-card' , ['student'=>$student, 'classrooms'=>$classrooms, 'courses'=>$courses])
        @endcomponent
    </div>
    {{-- transformar tabela ou lista de avaliações em componente--}}
    <div class="evaluations-container">
        <h1 class="subtitle">Historico de avaliações</h1>
        <table>
            <thead>
            <tr class="table-header">
                <th scope="col">Momento</th>
                <th scope="col">Tipo</th>
                <th scope="col">Nota</th>
                <th scope="col">Data</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($student->evaluations as $evaluation)
                <tr class="table-row">
                    <td>{{$evaluation->test->id}}</td>
                    <td>{{$evaluation->test->type->type}}</td>
                    <td>{{$evaluation->score}}</td>
                    <td>
                        @if($evaluation->test->date)
                            {{date('d/m/Y', strtotime($evaluation->test->date))}}
                        @else
                            Não realizado
                        @endif
                    </td>
                    <td>
                        {{--                                <a href={{ route('evaluations.show', $evaluation->id) }}><i class="fa-solid fa-magnifying-glass detailsBtn"></i></a>--}}
                        {{--                                <a href="{{ route('evaluations.edit', $evaluation->id) }}"><i class="fa-solid fa-pencil editBtn"></i></a>--}}
                        <a><i class="fa-solid fa-magnifying-glass detailsBtn"></i></a>
                        <a><i class="fa-solid fa-pencil editBtn"></i></a>
                        <a onclick="event.preventDefault();
                                    document.getElementById('evaluationRmvForm').submit();">
                            <i class="fa-regular fa-trash-can removeBtn"></i>
                        </a>
                        {{--                                <form id="evaluationRmvForm" action="{{route('evaluations.destroy', $evaluation->id)}}" method="POST">--}}
                        {{--                                    @csrf--}}
                        {{--                                    @method('DELETE')--}}
                        {{--                                </form>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
