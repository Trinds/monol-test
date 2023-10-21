<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.js"></script>
<canvas class="classroom-eval-chart" id="barChart"></canvas>
<script>
    var ctx = document.getElementById('barChart').getContext('2d');

    var studentNames = [];
    var tecnicoAverages = [];
    var psiquicoAverages = [];
    var allTecnico = [];
    var allPsiquico = [];

    @foreach ($classroom->students as $student)
        studentNames.push('{{$student->name}}');

        var studentTecnicoScores = [];
        var studentPsiquicoScores = [];

        @foreach ($student->evaluations as $evaluation)
            @if ($evaluation->test->type->type === 'Tecnico')
            {
                allTecnico.push({{ $evaluation->score }});
                studentTecnicoScores.push({{ $evaluation->score }});
            }
            @elseif ($evaluation->test->type->type === 'Psiquico')
            {
                studentPsiquicoScores.push({{ $evaluation->score }});
                allPsiquico.push({{ $evaluation->score }});
            }
            @endif
        @endforeach

        var tecnicoAverage = studentTecnicoScores.reduce((acc, score) => acc + score, 0) / studentTecnicoScores.length;
        var psiquicoAverage = studentPsiquicoScores.reduce((acc, score) => acc + score, 0) / studentPsiquicoScores.length;
        var averageAllTecnico = allTecnico.reduce((acc, score) => acc + score, 0) / allTecnico.length;
        var averageAllPsiquico = allPsiquico.reduce((acc, score) => acc + score, 0) / allTecnico.length;
        
        tecnicoAverages.push(tecnicoAverage);
        psiquicoAverages.push(psiquicoAverage);
    @endforeach

    var datasets = [
        {
            label: 'Media Tecnico: ' + averageAllTecnico.toFixed(2),
            data: tecnicoAverages,
            backgroundColor: tecnicoAverages.map(average => average > 9 ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)'), 
            borderColor: tecnicoAverages.map(average => average > 9 ? 'rgba(0, 255, 0, 1)' : 'rgba(255, 0, 0, 1)'), 
            borderWidth: 1
        },

        {
            label: 'Media Psiquico: '+ averageAllPsiquico.toFixed(2),
            data: psiquicoAverages,
            backgroundColor: psiquicoAverages.map(average => average > 9 ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)'), 
            borderColor: psiquicoAverages.map(average => average > 9 ? 'rgba(0, 255, 0, 1)' : 'rgba(255, 0, 0, 1)'), 
            borderWidth: 1
        }
    ];

    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: studentNames,
        datasets: datasets
    },
    options: {
        scales: 
        {
            y: 
            {
                min: 0,
                max: 20,
                ticks: 
                {
                    stepSize: 1,
                    color: 'blue'
                }
            },
            x: 
            {  
                ticks: 
                {
                    color: 'blue' 
                }
            },
            barThickness: 1, 
            categoryPercentage: 1.0, 
            barPercentage: 1.0 
        },
        plugins: 
        {
            tooltip: 
            {
                backgroundColor: 'rgb(56, 118, 191)',
                callbacks: 
                {
                    label: (tooltipItem) => 
                        {
                            const formattedValue = parseFloat(tooltipItem.formattedValue).toFixed(2);  
                            return ` ${tooltipItem.dataset.label}`;
                        }
                }
            },

            annotation: {
                drawTime: 'beforeDatasetsDraw',
                annotations: [
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
            }
        }
    }
});

</script>
