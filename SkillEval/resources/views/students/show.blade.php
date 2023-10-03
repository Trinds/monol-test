@extends('master.main')

@section('content')

    <div class="grid-container">
        <div class="chart-container">
            @component('components.students.evaluations-chart' , ['studentEvaluations'=>$student->evaluations])
            @endcomponent
        </div>

        <div class="details-container">
            @component('components.students.student-card' , ['student'=>$student])
            @endcomponent
        </div>
{{--        transformar tabela ou lista de avaliações em componente--}}
        <div class="evaluations-container">
            <div class="table-container">
                <table>
                    <caption>Avaliações</caption>
                    <tr>
                        <th scope="col">Sigla</th>
                        <th scope="col">Nome</th>
                        <th></th>
                    </tr>

                    <tr class="table-row">
                        <td>TPSI</td>
                        <td>Curso Programacao e Sistemas de Informacao</td>
                        <td>
                            <i class="fa-solid fa-magnifying-glass detailsBtn"></i>
                            <i class="fa-solid fa-pencil editBtn"></i>
                            <i class="fa-regular fa-trash-can removeBtn"></i>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection
