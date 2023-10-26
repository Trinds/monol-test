<div class="classroom-chart">
    <canvas class="classroom_chart" id="classroomChart"></canvas>
</div>
<div class="chart-options input-group-prepend">
    <select class="custom-select" onchange="momentScores(this)">
        <option value="Todos">Todos</option>
        <option value="Inicial">Inicial</option>
        <option value="Intermédio">Intermédio</option>
        <option value="Final">Final</option>
    </select>
    <input type="checkbox" checked value="0" onclick="typeScores(this)"> Técnico
    <input type="checkbox" checked value="1" onclick="typeScores(this)"> Psicotécnico

</div>
<script>
    console.log({!! json_encode($classTechEval) !!})

    function typeScores(type) {
        const isVisible = gradeChart.isDatasetVisible(type.value)

        if (isVisible === false)
            gradeChart.show(type.value)

        if (isVisible === true)
            gradeChart.hide(type.value)
    }

    function momentScores(moment) {
        gradeChart.config.options.parsing.yAxisKey = moment.value
        gradeChart.update()
    }

    {{--        SETUP BLOCK         --}}
    const data = {
        datasets: [
            {
                label: 'Técnico',
                data: {!! json_encode($classTechEval) !!},
                backgroundColor: 'rgba(56, 118, 191, .4)',
                borderColor: 'rgba(56, 118, 191, 1)',
                borderWidth: 1
            },
            {
                label: 'Psicotécnico',
                data: {!! json_encode($classPsychoEval) !!},
                backgroundColor: 'rgba(249, 148, 23, .4)',
                borderColor: 'rgba(249, 148, 23, 1)',
                borderWidth: 1
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
                yAxisKey: 'Todos'
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
    var gradeChart = new Chart(
        document.getElementById('classroomChart').getContext('2d'),
        configs
    )

</script>
