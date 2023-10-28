<div style="position: relative; ">
    <canvas id="donutChart"></canvas>
    <p id="noDataMessage" class="no-data-chart">Sem Dados</p>
</div>

<?php

$contagemAlunos = array();
$contagemTurmas = $cursosArray = array();
$alunosPorCurso = array();
foreach ($Turmas as $turma) {
    $Curso = $turma->course->abbreviation;

    if (!isset($contagemAlunos[$Curso])) {
        $contagemAlunos[$Curso] = 0;
    }

    if (!isset($contagemTurmas[$Curso])) {
        $contagemTurmas[$Curso] = 0;
    }

    $contagemAlunos[$Curso] += $turma->students->count();

    $contagemTurmas[$Curso]++;

    $cursosArray[] = $Curso;

    $alunosPorCurso[] = $turma->students->count();
}

?>

<script>
    var tiposDeCurso = {!! json_encode($cursosArray, JSON_HEX_TAG) !!};
    var numeroDeAlunosPorTipo = {!! json_encode($alunosPorCurso, JSON_HEX_TAG) !!};
    var ctx = document.getElementById('donutChart').getContext('2d');
    var totalDeAlunos = numeroDeAlunosPorTipo.reduce((total, valor) => total + valor, 0);
    if (totalDeAlunos === 0) {
        document.getElementById('noDataMessage').style.display = 'block';
        document.getElementById('AlunosPCurso').classList.add('text-center');
        tiposDeCurso = ['Nenhum Dado'];
        numeroDeAlunosPorTipo = [1];
        var donutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: tiposDeCurso,
                datasets: [{
                    data: numeroDeAlunosPorTipo,
                    backgroundColor: [
                        'rgba(21, 120, 167, 0.1)',
                    ],
                }],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        });
        ctx.globalAlpha = 0.5;
        ctx.shadowColor = 'rgba(21, 120, 167, 0.5)';
        ctx.shadowBlur = 10;
    } else {
        document.getElementById('noDataMessage').style.display = 'none';
        var tiposDeCursoUnicos = [...new Set(tiposDeCurso)];

        var numeroTotalDeAlunosPorTipo = tiposDeCursoUnicos.map(tipo =>
            numeroDeAlunosPorTipo.reduce((total, valor, index) => tiposDeCurso[index] === tipo ? total + valor : total, 0)
        );

        var donutChart = new Chart(ctx,
            {
                type: 'doughnut',
                data:
                    {
                        labels: tiposDeCursoUnicos,
                        datasets:
                            [{

                                data: numeroTotalDeAlunosPorTipo,
                                backgroundColor:
                                    [
                                        'rgba(21, 120, 167, 1)',
                                        'rgba(154, 83, 57, 1)',
                                        'rgba(229, 88, 35, 1)',
                                        'rgba(186, 133, 55, 1)',
                                        'rgba(78, 78, 78, 1)',
                                        'rgba(242, 147, 31, 1)',
                                        'rgba(25, 150, 208, 1)',
                                        'rgba(236, 118, 33, 1)',
                                        'rgba(130, 119, 78, 1)',
                                        'rgba(17, 90, 125, 1)',
                                    ],
                            }]
                    },
                options:
                    {
                        cutout: '65%',
                        plugins:
                            {
                                legend:
                                    {
                                        display: true,
                                        position: 'right',
                                        maxWidth: 250,
                                        title:
                                            {
                                                display: true,
                                            },
                                        labels: {
                                            boxWidth: 25
                                        }
                                    }
                            }
                    }
            });
    }
</script>

