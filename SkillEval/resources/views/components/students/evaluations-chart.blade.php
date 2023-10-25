<canvas class="student-eval-chart"   id="barChart"></canvas>

<script>
    var ctx = document.getElementById('barChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($studentEvaluations as $evaluation)
                    '{{$evaluation->test->type->type}}',
                @endforeach
            ],
            datasets: [{
                label: 'Nota',
                data: [
                    @foreach($studentEvaluations as $evaluation)
                        '{{$evaluation->score}}',
                    @endforeach
                ],
                backgroundColor: {!! $studentEvaluations !!}.map(evaluation =>
                    evaluation.score <= 6 ?
                        '#b91c1c'
                        : evaluation.score < 9.49 ?
                            '#ea580c'
                            : evaluation.score < 13 ?
                                '#facc15'
                                : evaluation.score < 17 ?
                                    '#166534'
                                    : '#22c55e'),
                borderColor:{!! $studentEvaluations !!}.map(evaluation =>
                    evaluation.score <= 6 ?
                        '#b91c1c'
                        : evaluation.score < 9.49 ?
                            '#ea580c'
                            : evaluation.score < 13 ?
                                '#facc15'
                                : evaluation.score < 17 ?
                                    '#166534'
                                    : '#22c55e'),
                borderWidth: 1
            }]
        },
        options:
            {
                scales:
                {
                    y: {
                        min: 0,
                        max: 20,
                        ticks: {
                            stepSize: 1,
                            color: '#4E4E4E'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#4E4E4E'
                        }
                    }
                },
                plugins:
                {
                    legend:
                    {
                        display: false,
                        labels:
                        {
                            boxWidth:0,
                        }
                    },
                    title:
                    {
                        display: true,
                        text: 'Notas de testes',
                        color: '#4E4E4E',
                        font:
                        {
                            size: 15,
                        },
                        padding: 10,
                    },
                }
        }
    });

</script>

