
<div class="dashboard-container">
        <form action="{{ route('reports.index') }}" method="GET">     
            <div class="row">
                <div class="col-md-3 border border-1">                
                    <p class="text-primary">Filtrar Turmas</p>
                    <div class="form-group">
                        <label for="courseDropdown">Curso</label>
                        <select  id="courseDropdown" name="course_id" class="form-control" style="font-weight: bold">
                            <option value="">Selecionar Curso</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->abbreviation }}" {{ (old('course_id', request('course_id')) == $course->abbreviation) ? 'selected' : '' }}>
                                    {{ $course->abbreviation }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classroomEditionDropdown">Turma</label>
                        <select id="classroomEditionDropdown" name="classroom_edition" class="form-control">
                            <option value="">Todas as Turmas</option>
                            @foreach($classEditions as $edition)
                                <option value="{{ $edition }}" {{ (old('classroom_edition', request('classroom_edition')) == $edition) ? 'selected' : '' }}>
                                    {{ $edition }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3 border border-1">                
                    <p class="text-primary">Filtrar Datas</p>
                    <div class="form-group">
                        <label for="start_date">Data de Início</label>
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Data de Conclusão</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 border border-1">
                    <p class="text-primary">Avaliação Técnica</p>
                    <div class="form-group">
                        <label for="min_average_tec">Média Mínima</label>
                        <input type="number" id="min_average_tec" name="min_average_tec" value="{{ request('min_average_tec') }}" class="form-control" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="max_average_tec">Média Máxima</label>
                        <input type="number" id="max_average_tec" name="max_average_tec" value="{{ request('max_average_tec') }}" class="form-control" step="0.01">
                    </div>
                </div>

                <div class="col-md-3 border border-1">
                    <p class="text-primary">Avaliação Psíquica</p>
                    <div class="form-group">
                        <label for="min_average_psi">Média Mínima</label>
                        <input type="number" id="min_average_psi" name="min_average_psi" value="{{ request('min_average_psi') }}" class="form-control" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="max_average_psi">Média Máxima</label>
                        <input type="number" id="max_average_psi" name="max_average_psi" value="{{ request('max_average_psi') }}" class="form-control" step="0.01">
                    </div>
                </div>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="active_classes" value="1" {{ request('active_classes', 0) ? 'checked' : '' }}> Só turmas Ativas
                </label>
            </div>

            <button type="submit">Extrair Relatório</button>
        </form>
    <div class="table-container">
        @if(request('course_id') != "")
        <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Formando</th>
                        <th>Turma</th>               
                        <th>Média Testes Técnico</th>
                        <th>Média Testes Psiquico</th> 
                        <th>Data de Início</th>
                        <th>Data de Conclusão</th>                
                        <th>Detalhes</th>
                    </tr>
                </thead>
            <tbody>
                @foreach($classrooms as $classroom)
                    @if(!request('classroom_edition') || $classroom->edition == request('classroom_edition'))
                        @foreach($classroom->students as $student)
                            @php
                                $studentAverages = ['psi' => ['total' => 0, 'count' => 0], 'tec' => ['total' => 0, 'count' => 0]];

                                foreach ($student->evaluations as $evaluation) 
                                {
                                    $typeId = $evaluation->test->type->id;
                                    $score = $evaluation->score;

                                    if ($typeId == 2) 
                                    {
                                        $studentAverages['psi']['total'] += $score;
                                        $studentAverages['psi']['count']++;
                                    } 
                                    elseif ($typeId == 1) 
                                    {
                                        $studentAverages['tec']['total'] += $score;
                                        $studentAverages['tec']['count']++;
                                    }
                                }

                                $psiAverage = ($studentAverages['psi']['count'] > 0) ? $studentAverages['psi']['total'] / $studentAverages['psi']['count'] : 0;
                                $tecAverage = ($studentAverages['tec']['count'] > 0) ? $studentAverages['tec']['total'] / $studentAverages['tec']['count'] : 0;


                                $minAverageTec = request('min_average_tec', 0);
                                $maxAverageTec = request('max_average_tec', 20);
                                $minAveragePsi = request('min_average_psi', 0);
                                $maxAveragePsi = request('max_average_psi', 20);
                                
                            @endphp
                                
                            @if($tecAverage > $minAverageTec && $psiAverage > $minAveragePsi && $tecAverage < $maxAverageTec && $psiAverage < $maxAveragePsi)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->classroom->course->abbreviation }} {{ $student->classroom->edition }}</td>
                                <td>
                                        Média Técnico: 
                                    @php                                    
                                        echo ($tecAverage < 10) ?
                                        '<span class="text-danger font-weight-bold">' . number_format($tecAverage, 2) . '</span><br>' 
                                        : 
                                        '<span class="text-primary font-weight-bold">' . number_format($tecAverage, 2) . '</span><br>';
                                    @endphp
                                </td>
                                <td>
                                        Média Psiquico: 
                                    @php
                                        echo ($psiAverage < 10) ?
                                        '<span class="text-danger font-weight-bold">' . number_format($psiAverage, 2) . '</span><br>' 
                                        : 
                                        '<span class="text-primary font-weight-bold">' . number_format($psiAverage, 2) . '</span><br>';
                                    @endphp
                                </td>
                                <td>{{ date('d-m-Y', strtotime($classroom->start_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($classroom->end_date)) }}</td>
                                <td>
                                    <a href="/students/{{ $student->id }}"><button>Formando</button></a>                                
                                    <a href="/classrooms/{{ $student->classroom_id }}"><button>Turma</button></a>
                                </td>
                            </tr>
                            @endif

                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>        
        @endif
        
    </div>
