<link href="{{ asset('css/reports.css') }}" rel="stylesheet">
<div class="dashboard-container">
    <form action="{{ route('reports.index') }}" method="GET">
    <div class="row border border-1">
    <div class="col-md-3 form-group">
        <label for="start_date">Data de Início</label>
        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
    </div>

    <div class="col-md-3 form-group">
        <label for="end_date">Data de Conclusão</label>
        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
    </div>

    <div class="col-md-2 form-group">
        <label for="courseDropdown">Curso</label>
        <select id="courseDropdown" name="course_id" class="form-control">
            <option value="">Sigla curso</option>
            @foreach($courses as $course)
                <option value="{{ $course->abbreviation }}" {{ (old('course_id', request('course_id')) == $course->abbreviation) ? 'selected' : '' }}>
                    {{ $course->abbreviation }}
                </option>
            @endforeach
        </select>
    </div>   


    <div class="col-md-2 form-group">
        <label for="classroomEditionDropdown">Turma</label>
        <select id="classroomEditionDropdown" name="classroom_edition" class="form-control">
            <option value="">Todas as Edições</option>
            @foreach($classEditions as $edition)
                <option value="{{ $edition }}" {{ (old('classroom_edition', request('classroom_edition')) == $edition) ? 'selected' : '' }}>
                    {{ $edition }}
                </option>
            @endforeach
        </select>
    </div>



    

    <div class="col-md-2 form-group">
        <label for="min_average">Média Mínima</label>
        <input type="number" id="min_average" name="min_average" value="{{ request('min_average') }}" class="form-control" step="0.01">
    </div>

    <div class="col-md-2 form-group">
        <label for="max_average">Média Máxima</label>
        <input type="number" id="max_average" name="max_average" value="{{ request('max_average') }}" class="form-control" step="0.01">
    </div>
</div>


        <button type="submit">Relatório</button>
    </form>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Formando</th>
                <th>Turma</th>
                <th>Média Testes</th>
                <th>Data de Início</th>
                <th>Data de Conclusão</th>
            </tr>
        </thead>

        @if(request('course_id') != "")
        <tbody>
            @foreach($classrooms as $classroom)
            @if(!request('classroom_edition') || $classroom->edition == request('classroom_edition'))  


                @foreach($classroom->students as $student)
                    @php
                    
                        $studentAverages = [];
                        foreach ($student->evaluations as $evaluation) 
                        {
                            $typeId = $evaluation->test->type->id;
                            $score = $evaluation->score;
                            if (!isset($studentAverages[$typeId])) 
                                $studentAverages[$typeId] = ['total' => 0, 'count' => 0];
                            $studentAverages[$typeId]['total'] += $score;
                            $studentAverages[$typeId]['count']++;
                        }

                        $studentAverage = 0;
                        $averageCount = 0; 

                        foreach ($studentAverages as $typeId => $data) 
                        {
                            $average = $data['total'] / $data['count'];
                            $type = \App\Type::find($typeId);
                            $studentAverage += $average;
                            $averageCount++; // Increment the average count
                        }
                        $studentAverage = ($averageCount > 0) ? $studentAverage / $averageCount : 0; // Calculate the overall average
                    @endphp


                    @php
                        $minAverage = request('min_average', 0);
                        $maxAverage = request('max_average', 20);
                    @endphp

                    @if (
                        ($minAverage === 0 || $average >= $minAverage)
                        &&
                        ($maxAverage === 20 || $average <= $maxAverage)
                    )


                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->classroom->course->abbreviation }}-{{ $student->classroom->edition }}</td>
                        <td>
                            @php
                                foreach ($studentAverages as $typeId => $data)
                                {
                                    $average = $data['total'] / $data['count'];
                                    $type = \App\Type::find($typeId);

                                    echo ($average < 10) 
                                    ? '<span class="text-danger font-weight-bold">' . $type->type . ': ' . number_format($average, 2) . '</span><br>'
                                    : '<span class="text-primary font-weight-bold">' . $type->type . ': ' . number_format($average, 2) . '</span><br>';

                                }
                            @endphp
                        </td>        
                        <td>{{ date('d-m-Y', strtotime($classroom->start_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($classroom->end_date)) }}</td>     
                        <td>
                            <a href="/students/{{ $student->id }}"><button>Formando</button></a>
                        </td>
                    </tr>
                    @endif
                @endforeach
            
            @endif
            @endforeach
        </tbody>
        @endif
    </table>
</div>
