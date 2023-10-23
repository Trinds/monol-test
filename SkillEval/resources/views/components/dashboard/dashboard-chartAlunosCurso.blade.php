<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.js"></script>
<canvas id="donutChart"></canvas>

<?php
        $contagemAlunos = array();
        $contagemTurmas = $cursosArray = array();
        $alunosPorCurso = array(); 

        foreach ($Turmas as $turma) {
            $nAlunos = $turma->students->count();
            $Cursos = $turma->course->abbreviation;

            if (!isset($contagemAlunos[$Cursos])) {
                $contagemAlunos[$Cursos] = 0;
            }

            if (!isset($contagemTurmas[$Cursos])) {
                $contagemTurmas[$Cursos] = 0;
            }

            $contagemAlunos[$Cursos] += $nAlunos;

            $contagemTurmas[$Cursos]++;

            $cursosArray[] = $Cursos;

            $alunosPorCurso[] = $nAlunos;
        }

        $cursosJson = json_encode($cursosArray);
        $alunosPorCursoJson = json_encode($alunosPorCurso);
?>

<script>
    var tiposDeCurso  = <?php echo $cursosJson; ?>;
    var numeroDeAlunosPorTipo  = <?php echo $alunosPorCursoJson; ?>;


    var tiposDeCursoUnicos = [...new Set(tiposDeCurso)];

    var numeroTotalDeAlunosPorTipo = tiposDeCursoUnicos.map(tipo => 
        numeroDeAlunosPorTipo.reduce((total, valor, index) => tiposDeCurso[index] === tipo ? total + valor : total, 0)
    );



    var ctx = document.getElementById('donutChart').getContext('2d');

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
                    'rgba(242, 147, 31, 1)',
                    'rgba(25, 150, 208, 1)',
                    'rgba(236, 118, 33, 1)',
                    'rgba(130, 119, 78, 1)',
                    'rgba(17, 90, 125, 1)',
                    'rgba(21, 120, 167, 1)',
                    'rgba(154, 83, 57, 1)',
                    'rgba(229, 88, 35, 1)',
                    'rgba(186, 133, 55, 1)',
                    'rgba(78, 78, 78, 1)',
                ],
           }]
        },
        options: 
        {
            cutout: '70%', 
            plugins: 
                {
                    legend: 
                    {   
                        display: true,
                        position: 'right',           
                        title: 
                        {
                            display: true,
                            text: 'Alunos Por Curso',
                        },    
                    } 
                }
        }
    });
</script>

