<div class="student-chart">
    <canvas class="student-eval-chart" id="studentChart"></canvas>
</div>
<div class="chart-options input-group-prepend">
    <select class="custom-select" onchange="momentScores(this)">
        <option value="Inicial" selected>Inicial</option>
        <option value="Intermédio">Intermédio</option>
        <option value="Final">Final</option>
        <option value="Todos">Todos</option>
    </select>
    <input type="checkbox" checked value="0" onclick="typeScores(this)"> Técnico
    <input type="checkbox" checked value="1" onclick="typeScores(this)"> Psicotécnico
</div>

<script>

    function typeScores(type) {
        const isVisible = studentChart.isDatasetVisible(type.value)

        if (isVisible === false)
            studentChart.show(type.value)

        if (isVisible === true)
            studentChart.hide(type.value)
    }

    function momentScores(moment) {
        studentChart.config.options.parsing.yAxisKey = moment.value
        studentChart.update()
    }

    {{--        SETUP BLOCK         --}}
    const data = {
        datasets: [
            {
                label: 'Técnico',
                data: [
                    {!! json_encode($techScores) !!}
                ],
                backgroundColor: 'rgba(56, 118, 191, .4)',
                borderColor: 'rgba(56, 118, 191, 1)',
                borderWidth: 3,
                borderRadius: 5,
                barPercentage: 0.5
            },
            {
                label: 'Psicotécnico',
                data: [
                    {!! json_encode($psychScores) !!}
                ],
                backgroundColor: 'rgba(249, 148, 23, .4)',
                borderColor: 'rgba(249, 148, 23, 1)',
                borderWidth: 3,
                borderRadius: 5,
                barPercentage: 0.5
            },
        ]
    }

    {{--        CONFIG BLOCK         --}}
    const configs = {
        type: 'bar',
        data,
        options: {
            aspectRatio: -16,
            responsive: true,
            plugins: {
                legend: {
                    onClick: null
                },
            },
            parsing: {
                xAxisKey: 'x',
                yAxisKey: 'Inicial'
            },
            scales:
                {
                    y:
                        {
                            min: 0,
                            max: 20,
                            ticks:
                                {
                                    stepSize: 1,
                                    color: 'rgba(78, 78, 78, 1)'
                                }
                        },
                    x:
                        {
                            ticks:
                                {
                                    color: 'rgba(78, 78, 78, 1)'
                                }
                        }
                }
        }
    }

    {{--        RENDER BLOCK         --}}
    var studentChart = new Chart(
        document.getElementById('studentChart').getContext('2d'),
        configs
    )

</script>

