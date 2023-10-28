@extends('master.main')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/3.0.1/chartjs-plugin-annotation.min.js"></script>
    <script type="module" src="{{asset('js/editStudentCard.js')}}"></script>
    <script type="module" src="{{asset('js/classroomsFilter.js')}}"></script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('css/students.css')}}">
@endsection

@section('content')
    <div class="title">
        <h1>Detalhes do Formando</h1>
    </div>
    <div class="grid-container">
        <div class="chart-area">
            @component('components.students.evaluations-chart' , ['techScores' => $techScores, 'psychScores' => $psychScores, 'classTechAvg' => $classTechAvg, 'classPsychAvg' => $classPsychAvg])
            @endcomponent
        </div>

        <div class="details-container">
            @component('components.students.student-card' , ['student'=>$student, 'classrooms'=>$classrooms, 'courses'=>$courses])
            @endcomponent
        </div>
        {{-- transformar tabela ou lista de avaliações em componente--}}
        <div class="evaluations-container">
            <h1 class="subtitle">Histórico de avaliações</h1>
            <div class="add-evaluation">
                <a href="{{ route('evaluations.create.student', $student->id) }}">Adicionar Avaliação <i
                        class="fa-solid fa-plus-circle addBtn"></i></a>
            </div>
            @if($student->evaluations->count() == 0)
                <div class="alert alert-info m-5">
                    Não foram encontrados resultados.
                </div>
            @else
                <div class="table-container">
                    <table class="large-table">
                        <thead>
                        <tr class="table-header">
                            <th scope="col">Momento</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Nota</th>
                            <th scope="col">Data</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student->evaluations as $evaluation)
                            <tr class="table-row">
                                <td>{{$evaluation->test->moment}}</td>
                                <td>{{$evaluation->test->type->type}}</td>
                                <td>{{$evaluation->score}}</td>
                                <td>
                                    @if($evaluation->date)
                                        {{date('d/m/Y', strtotime($evaluation->date))}}
                                    @else
                                        Não realizado
                                    @endif
                                </td>
                                <td>
                                    <a><i data-student-id="{{ $evaluation->student_id }}"
                                          data-test-id="{{ $evaluation->test_id }}"
                                          class="fa-regular fa-trash-can removeBtn delete-button"></i></a>
                                </td>
                            </tr>
                            <form method="POST" class="hidden-form"
                                  id="evaluationRmvForm_{{ $evaluation->student_id }}_{{ $evaluation->test_id }}"
                                  action="{{ route('evaluations.destroy', ['studentId' => $evaluation->student_id, 'testId' => $evaluation->test_id]) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
        </div>
    </div>


    <script>
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("delete-button")) {
                event.preventDefault();
                const studentId = event.target.getAttribute("data-student-id");
                const testId = event.target.getAttribute("data-test-id");
                const form = document.getElementById(`evaluationRmvForm_${studentId}_${testId}`);
                if (form) {
                    form.submit();
                }
            }
        });
    </script>

@endsection
