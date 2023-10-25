<canvas id="barChart"></canvas>

<?php
$allTecnico = [];
$allPsiquico = [];
$studentNames = [];
$tecnicoAverages = [];
$psiquicoAverages = [];
$averageAllTecnico = 0;
$averageAllPsiquico = 0;


foreach ($classroom->students as $student) {
    $studentTecnicoScores = [];
    $studentPsiquicoScores = [];
    $studentNames[] = $student->name;

    foreach ($student->evaluations as $evaluation) {
        if ($evaluation->test->type->type === 'Tecnico') {
            $allTecnico[] = $evaluation->score;
            $studentTecnicoScores[] = $evaluation->score;
        } elseif ($evaluation->test->type->type === 'Psiquico') {
            $allPsiquico[] = $evaluation->score;
            $studentPsiquicoScores[] = $evaluation->score;
        }
    }

    $averageAllTecnico = array_sum($allTecnico) / count($allTecnico);
    $averageAllPsiquico = array_sum($allPsiquico) / count($allPsiquico);
    $tecnicoAverage = array_sum($studentTecnicoScores) / count($studentTecnicoScores);
    $psiquicoAverage = array_sum($studentPsiquicoScores) / count($studentPsiquicoScores);

    $tecnicoAverages[] = $tecnicoAverage;
    $psiquicoAverages[] = $psiquicoAverage;
}

// Pass all PHP variables and arrays to JavaScript
echo '<script>';
echo 'var allTecnico = ' . json_encode($allTecnico) . ';';
echo 'var allPsiquico = ' . json_encode($allPsiquico) . ';';
echo 'var studentNames = ' . json_encode($studentNames) . ';';
echo 'var tecnicoAverages = ' . json_encode($tecnicoAverages) . ';';
echo 'var psiquicoAverages = ' . json_encode($psiquicoAverages) . ';';
echo 'var averageAllTecnico = ' . json_encode($averageAllTecnico) . ';';
echo 'var averageAllPsiquico = ' . json_encode($averageAllPsiquico) . ';';
echo '</script>';

?><!----><!---->


<script>
    //get php variables

    var allTecnico = <?php echo json_encode($allTecnico); ?><!----><!---->;
    var allPsiquico = <?php echo json_encode($allPsiquico); ?><!----><!---->;
    var studentNames = <?php echo json_encode($studentNames); ?><!----><!---->;
    var tecnicoAverages = <?php echo json_encode($tecnicoAverages); ?><!----><!---->;
    var psiquicoAverages = <?php echo json_encode($psiquicoAverages); ?><!----><!---->;
    var averageAllTecnico = <?php echo json_encode($averageAllTecnico); ?><!----><!---->;
    var averageAllPsiquico = <?php echo json_encode($averageAllPsiquico); ?>;

    var datasets =
        [
            {
                label: 'Técnico: ' + averageAllTecnico.toFixed(2),
                data: tecnicoAverages,
                backgroundColor: tecnicoAverages.map(average =>
                    average <= 6 ?
                        '#b91c1c'
                        : average < 9.49 ?
                            '#ea580c'
                            : average < 13 ?
                                '#facc15'
                                : average < 17 ?
                                    '#166534'
                                    : '#22c55e'),
                borderWidth: 1.5,
                borderRadius: 3
            },
            {
                label: 'Psíquico: ' + averageAllPsiquico.toFixed(2),
                data: psiquicoAverages,
                backgroundColor: psiquicoAverages.map(average =>
                    average <= 6 ?
                        '#b91c1c'
                        : average < 9.49 ?
                            '#ea580c'
                            : average < 13 ?
                                '#facc15'
                                : average < 17 ?
                                    '#65a30d'
                                    : '#a3e635'),
                borderWidth: 1.5,
                borderRadius: 3
            }
        ];

    var ctx = document.getElementById('barChart').getContext('2d');

    var myChart = new Chart(ctx,
        {
            type: 'bar',
            data:
                {
                    labels: studentNames,
                    datasets: datasets
                },
            options:
                {
                    responsive:true,
                    aspectRatio: -10,
                    scales:
                        {
                            y:
                                {
                                    min: 0,
                                    max: 20,
                                    ticks:
                                        {
                                            stepSize: 1,
                                            color: '#4E4E4E'
                                        }
                                },
                            x:
                                {
                                    ticks:
                                        {
                                            color: '#4E4E4E'
                                        }
                                }
                        },
                    plugins:
                        {
                            legend:
                                {
                                    onClick: (e, legendItem, legend) => {
                                        const datasets = legend.legendItems.map((dataset)=>{
                                            return dataset.text
                                        })

                                        const index = datasets.indexOf(legendItem.text)
                                        legend.chart.isDatasetVisible(index) === true ?
                                            legend.chart.hide(index) : legend.chart.show(index)
                                    },
                                    display: true,
                                    labels:
                                        {
                                            boxWidth: 10,
                                            generateLabels: (myChart) => {
                                                let visibility = []
                                                for (let i = 0; i < myChart.data.datasets.length; i++){
                                                    myChart.isDatasetVisible(i) === false ?
                                                        visibility.push(true) : visibility.push(false)
                                                }

                                                return myChart.data.datasets.map((dataset, index) => ({
                                                    text: dataset.label,
                                                    fillStyle: index === 0 ? 'rgba(0, 71, 254, .5)' : 'rgba(229, 88, 35, .5)',
                                                    strokeStyle: index === 0 ? 'rgba(0, 71, 254, 1)' : 'rgba(229, 88, 35, 1)',
                                                    fontColor: index === 0 ? 'rgba(0, 71, 254, .5)' : 'rgba(229, 88, 35, .5)',
                                                    hidden: visibility[index]
                                                })
                                            )
                                        }
                                    }
                                },
                            title:
                                {
                                    display: true,
                                    color: '#4E4E4E',
                                    text: 'Médias de testes',
                                    font:
                                        {
                                            size: 14,
                                        },
                                },
                            tooltip:
                                {
                                    backgroundColor: 'rgba(78, 78, 78, .7)',
                                    callbacks: {
                                        label: (tooltipItem) => {
                                            const value = tooltipItem.parsed.y.toFixed(2);
                                            const datasetIndex = tooltipItem.datasetIndex;
                                            const type = datasetIndex === 0 ? 'Técnico' : 'Psíquico';
                                            return `${type}: ${value}`;
                                        }
                                    }
                                },
                            annotation:
                                {
                                    annotations:
                                        [
                                            {
                                                z: 10,
                                                scaleID: 'y',
                                                type: 'line',
                                                borderWidth: 3,
                                                mode: 'horizontal',
                                                value: averageAllTecnico,
                                                borderColor: 'rgba(0, 71, 254, .5)',
                                            },
                                            {
                                                z: 10,
                                                type: 'line',
                                                scaleID: 'y',
                                                borderWidth: 3,
                                                mode: 'horizontal',
                                                value: averageAllPsiquico,
                                                borderColor: 'rgba(229, 88, 35, .5)',
                                            }
                                        ],
                                    drawTime: 'beforeDatasetsDraw',
                                },
                        }
                }
        });
</script>
