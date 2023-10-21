<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">


<form action="{{ route('reports.index') }}" method="GET" >
    <div class="form-group">
        <label for="start_date">Data de Início</label>
        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">

        <label for="end_date">Data de Fim</label>
        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">

        <label for="courseDropdown">Selecionar Curso</label>
        <select id="courseDropdown" name="course_id" class="form-control">
            <option value="">Escolher um curso</option>
            @foreach($courses as $course)
                <option value="{{ $course->abbreviation }}" @if(request('course_id') == $course->abbreviation) selected @endif>
                    {{ $course->abbreviation }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" >Filtrar</button>
</form>


        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Turma</th>
                    <th>Sigla</th> 
                    <th>NºFormandos</th> 
                    <th>Média Testes</th>
                    <th>Data de Início</th>
                    <th>Data de Conclusão</th>
                </tr>
            </thead>
            <tbody>
            @foreach($classrooms as $classroom)
                @if (request('course_id') === '' || request('course_id') === $classroom->course->abbreviation)
                <tr>
                    <td>{{ $classroom->edition }}</td>
                    <td>{{ $classroom->course->abbreviation }}</td>
                    <td>{{ $classroom->students->count() }}</td>
                    <td>
                        @if ($classroom->students->isNotEmpty())
                            @php
                                $typeAverages = [];
                            @endphp
                            @foreach ($classroom->students as $student)
                                @foreach ($student->evaluations as $evaluation)
                                    @php
                                        $typeId = $evaluation->test->type->id;
                                        $score = $evaluation->score;
                                        if (!isset($typeAverages[$typeId])) {
                                            $typeAverages[$typeId] = ['total' => 0, 'count' => 0];
                                        }
                                        $typeAverages[$typeId]['total'] += $score;
                                        $typeAverages[$typeId]['count']++;
                                    @endphp
                                @endforeach
                            @endforeach
                            @foreach ($typeAverages as $typeId => $data)
                                @php
                                    $average = $data['total'] / $data['count'];
                                    $type = \App\Type::find($typeId);
                                @endphp
                                <div>
                                    Teste {{ $type->type }} = {{ number_format($average, 2) }}
                                </div>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $classroom->start_date }}</td>
                    <td>{{ $classroom->end_date }}</td>
                    <td>
                        <a  href="/classrooms/{{ $classroom->id }}" ><button>Grafico</button></a>
                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>