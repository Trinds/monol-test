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
                'rgb(237, 125, 49, 0.7)',
                'rgb(25, 38, 85, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)'
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

