@if(request('course_id'))
    <div class="table-container">
        <table class="large-table">
            <thead>
            <tr class="table-header">
                <th>Formando</th>
                <th>Turma</th>
                <th>Média Técnica</th>
                <th>Média Psicotécnica</th>
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

                        @if($tecAverage >= $minAverageTec && $psiAverage >= $minAveragePsi && $tecAverage <= $maxAverageTec && $psiAverage <= $maxAveragePsi)
                            <tr class="table-row">
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->classroom->course->abbreviation }} {{ $student->classroom->edition }}</td>
                                <td>
                                    @php
                                        echo ($tecAverage < 10) ?
                                        '<span class="text-danger font-weight-bold">' . number_format($tecAverage, 2) . '</span><br>'
                                        :
                                        '<span class="text-primary font-weight-bold">' . number_format($tecAverage, 2) . '</span><br>';
                                    @endphp
                                </td>
                                <td>
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
                                    <a class="text-decoration-none" href="/students/{{ $student->id }}">
                                        <button>Formando</button>
                                    </a>
                                    <a class="text-decoration-none" href="/classrooms/{{ $student->classroom_id }}">
                                        <button>Turma</button>
                                    </a>
                                </td>
                            </tr>
                        @endif

                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endif
