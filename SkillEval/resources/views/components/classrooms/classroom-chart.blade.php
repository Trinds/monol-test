<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas class="classroom-eval-chart" id="barChart"></canvas>
<script>
    var ctx = document.getElementById('barChart').getContext('2d');

    var studentNames = [];
    var tecnicoAverages = [];
    var psiquicoAverages = [];

    @foreach ($classroom->students as $student)
        studentNames.push('{{$student->name}}');

        var studentTecnicoScores = [];
        var studentPsiquicoScores = [];

        @foreach ($student->evaluations as $evaluation)
            // Check the test type and add to the respective arrays
            if ('{{$evaluation->test->type->type}}' === 'Tecnico') {
                studentTecnicoScores.push({{$evaluation->score}});
            } else if ('{{$evaluation->test->type->type}}' === 'Psiquico') {
                studentPsiquicoScores.push({{$evaluation->score}});
            }
        @endforeach

        // Calculate the average for each type of test
        var tecnicoAverage = studentTecnicoScores.reduce((acc, score) => acc + score, 0) / studentTecnicoScores.length;
        var psiquicoAverage = studentPsiquicoScores.reduce((acc, score) => acc + score, 0) / studentPsiquicoScores.length;

        tecnicoAverages.push(tecnicoAverage);
        psiquicoAverages.push(psiquicoAverage);
    @endforeach

    var datasets = [
        {
            label: 'Tecnico',
            data: tecnicoAverages,
            backgroundColor: 'rgb(48, 133, 195)',
            borderColor: tecnicoAverages.map(average => average > 9 ? 'green' : 'red'), // Conditionally set border color
            borderWidth: 3
        },
        {
            label: 'Psiquico',
            data: psiquicoAverages,
            backgroundColor: 'rgb(249, 148, 23)',
            borderColor: psiquicoAverages.map(average => average > 9 ? 'green' : 'red'), // Conditionally set border color
            borderWidth: 3
        }
    ];

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
                        stepSize: 1
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                            return datasetLabel + ': Nota - ' + tooltipItem.formattedValue;
                        }
                    }
                }
            }
        }
    });
</script>
