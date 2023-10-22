<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<canvas class="classroom_chart" id="barChart"></canvas>

<?php
    $studentNames = [];
    $tecnicoAverages = [];
    $psiquicoAverages = [];
    $allTecnico = [];
    $allPsiquico = [];

    foreach ($classroom->students as $student) {
        $studentNames[] = $student->name;

        $studentTecnicoScores = [];
        $studentPsiquicoScores = [];

        foreach ($student->evaluations as $evaluation) {
            if ($evaluation->test->type->type === 'Tecnico') {
                $allTecnico[] = $evaluation->score;
                $studentTecnicoScores[] = $evaluation->score;
            } elseif ($evaluation->test->type->type === 'Psiquico') {
                $allPsiquico[] = $evaluation->score;
                $studentPsiquicoScores[] = $evaluation->score;
            }
        }

        $tecnicoAverage = array_sum($studentTecnicoScores) / count($studentTecnicoScores);
        $psiquicoAverage = array_sum($studentPsiquicoScores) / count($studentPsiquicoScores);
        $averageAllTecnico = array_sum($allTecnico) / count($allTecnico);
        $averageAllPsiquico = array_sum($allPsiquico) / count($allPsiquico);

        $tecnicoAverages[] = $tecnicoAverage;
        $psiquicoAverages[] = $psiquicoAverage;
    }

    // Pass all PHP variables and arrays to JavaScript
    echo '<script>';
    echo 'var studentNames = ' . json_encode($studentNames) . ';';
    echo 'var tecnicoAverages = ' . json_encode($tecnicoAverages) . ';';
    echo 'var psiquicoAverages = ' . json_encode($psiquicoAverages) . ';';
    echo 'var averageAllTecnico = ' . json_encode($averageAllTecnico) . ';';
    echo 'var averageAllPsiquico = ' . json_encode($averageAllPsiquico) . ';';
    echo 'var allTecnico = ' . json_encode($allTecnico) . ';';
    echo 'var allPsiquico = ' . json_encode($allPsiquico) . ';';
    echo '</script>';
    ?>

    <!----------------------------------------------------------------------------------------------------->
    <!----------------------------------------------------------------------------------------------------->
    <!----------------------------------------------------------------------------------------------------->

    <script>
        //get php variables
            var studentNames = <?php echo json_encode($studentNames); ?>;
            var tecnicoAverages = <?php echo json_encode($tecnicoAverages); ?>;
            var psiquicoAverages = <?php echo json_encode($psiquicoAverages); ?>;
            var averageAllTecnico = <?php echo json_encode($averageAllTecnico); ?>;
            var averageAllPsiquico = <?php echo json_encode($averageAllPsiquico); ?>;
            var allTecnico = <?php echo json_encode($allTecnico); ?>;
            var allPsiquico = <?php echo json_encode($allPsiquico); ?>;
        
        var datasets = [
            {
                label: 'Psíquico: ' + averageAllPsiquico.toFixed(2),
                data: tecnicoAverages,
                backgroundColor: tecnicoAverages.map(average => average > 9 ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)'),
                borderColor: tecnicoAverages.map(average => average > 9 ? 'rgba(0, 255, 0, 1)' : 'rgba(255, 0, 0, 1)'),
                borderWidth: 1
            },
            {
                label: 'Técnico: ' + averageAllTecnico.toFixed(2),
                data: psiquicoAverages,
                backgroundColor: psiquicoAverages.map(average => average > 9.49 ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)'),
                borderColor: psiquicoAverages.map(average => average > 9.49 ? 'rgba(0, 255, 0, 1)' : 'rgba(255, 0, 0, 1)'),
                borderWidth: 1
            }
        ];

        var ctx = document.getElementById('barChart').getContext('2d');
        
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: studentNames,
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        min: 0,
                        max: 20,
                        ticks: {
                            stepSize: 1,
                            color: 'blue'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'blue'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Médias de testes',
                        font: {
                            size: 16,
                            weight: 'bold',
                            family: 'Arial, sans-serif',
                        },
                        padding: 10,
                    },
                    tooltip: 
                    {
                        backgroundColor: 'rgb(56, 118, 191)',
                        callbacks: {
                            label: (tooltipItem) => 
                            {
                                const datasetIndex = tooltipItem.datasetIndex;
                                const type = datasetIndex === 0 ? 'Técnico' : 'Psíquico';
                                const value = tooltipItem.parsed.y.toFixed(2);
                                return `${type}: ${value}`;
                            }
                        }
                    },
                    annotation: 
                    {
                        drawTime: 'beforeDatasetsDraw',
                        annotations: 
                        [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: averageAllTecnico,
                                borderColor: 'rgb(48, 133, 195)',
                                borderWidth: 3,
                                z: 1,
                            },
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: averageAllPsiquico,
                                borderColor: 'rgb(249, 148, 23)',
                                borderWidth: 3,
                                z: 1,
                            }
                        ]
                    },
                }
            }
        });
    </script>