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
        <label for="min_average">Média Mínima</label>
        <input type="number" id="min_average" name="min_average" value="{{ request('min_average') }}" class="form-control" step="0.01">
        
        <label for="max_average">Média Máxima</label>
        <input type="number" id="max_average" name="max_average" value="{{ request('max_average') }}" class="form-control" step="0.01">
    </div>

    <button type="submit" >Filtrar</button>
</form>


<table class="table mt-4">
    <thead>
        <tr>
            <th>Turma</th>
            <th>Sigla</th>
            <th>Aluno</th>
            <th>Média Testes</th>
            <th>Data de Início</th>
            <th>Data de Conclusão</th>
        </tr>
    </thead>
    <tbody>
    @foreach($classrooms as $classroom)
        @if (request('course_id') === '' || request('course_id') === $classroom->course->abbreviation)
            @foreach ($classroom->students as $student)
                @php
                    $studentAverages = [];
                @endphp
                @foreach ($student->evaluations as $evaluation)
                    @php
                        $typeId = $evaluation->test->type->id;
                        $score = $evaluation->score;
                        if (!isset($studentAverages[$typeId])) {
                            $studentAverages[$typeId] = ['total' => 0, 'count' => 0];
                        }
                        $studentAverages[$typeId]['total'] += $score;
                        $studentAverages[$typeId]['count']++;
                    @endphp
                @endforeach
                @php
                    $allAveragesWithinRange = true;
                    $studentAverage = 0;
                @endphp
                @foreach ($studentAverages as $typeId => $data)
                    @php
                        $average = $data['total'] / $data['count'];
                        $type = \App\Type::find($typeId);
                        $studentAverage += $average;
                    @endphp
                    @if (
                        (request('min_average') !== '' && $average < request('min_average')) ||
                        (request('max_average') !== '' && $average > request('max_average'))
                    )
                        @php
                            $allAveragesWithinRange = false;
                            break;
                        @endphp
                    @endif
                @endforeach
                @if ($allAveragesWithinRange)
                    <tr>
                        <td>{{ $classroom->edition }}</td>
                        <td>{{ $classroom->course->abbreviation }}</td>
                        <td>{{ $student->name }}</td>
                        <td>
                            @foreach ($studentAverages as $typeId => $data)
                                @php
                                    $average = $data['total'] / $data['count'];
                                    $type = \App\Type::find($typeId);
                                @endphp
                                {{ $type->type }}: {{ number_format($average, 2) }}<br>
                            @endforeach
                        </td>
                        <td>{{ $classroom->start_date }}</td>
                        <td>{{ $classroom->end_date }}</td>
                        <td>
                            <a href="/students/{{ $student->id }}"><button>ALUNO</button></a>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif
    @endforeach
</tbody>


</table>

    </div>