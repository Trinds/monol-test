<div class="classroom-chart">
    <canvas class="classroom_chart" id="classroomChart"></canvas>
</div>
<div class="chart-options input-group-prepend">
    <select class="custom-select" onchange="momentScores(this)">
        <option value="Inicial">Inicial</option>
        <option value="Intermédio">Intermédio</option>
        <option value="Final">Final</option>
        <option value="Todos">Todos</option>
    </select>
    <input type="checkbox" checked value="0" onclick="typeScores(this)"> Técnico
    <input type="checkbox" checked value="1" onclick="typeScores(this)"> Psicotécnico

</div>
<script>
    function typeScores(type) {
        const isVisible = gradeChart.isDatasetVisible(type.value)

        if (isVisible === false) {
            gradeChart.show(type.value)
            gradeChart.config.options.plugins.annotation.annotations[type.value].display = true
        }

        if (isVisible === true) {
            gradeChart.hide(type.value)
            gradeChart.config.options.plugins.annotation.annotations[type.value].display = false
        }
    }

    function momentScores(moment) {
        gradeChart.config.options.parsing.yAxisKey = moment.value
        gradeChart.config.options.plugins.annotation.annotations[0].value = {!! json_encode($techAvg) !!}[moment.value]
        gradeChart.config.options.plugins.annotation.annotations[0].label.content = ['Média: ' + {!! json_encode($techAvg) !!}[moment.value].toFixed(2)]
        gradeChart.config.options.plugins.annotation.annotations[1].value = {!! json_encode($psychAvg) !!}[moment.value]
        gradeChart.config.options.plugins.annotation.annotations[1].label.content = ['Média: ' + {!! json_encode($psychAvg) !!}[moment.value].toFixed(2)]
        gradeChart.update()
    }

    {{--        SETUP BLOCK         --}}
    const data = {
        datasets: [
            {
                label: 'Técnico',
                data: {!! json_encode($classTechEval) !!},
                backgroundColor: 'rgba(56, 118, 191, .7)',
                borderColor: 'rgba(56, 118, 191, 1)',
                borderWidth: 2,
                borderRadius: 3
            },
            {
                label: 'Psicotécnico',
                data: {!! json_encode($classPsychoEval) !!},
                backgroundColor: 'rgba(249, 148, 23, .7)',
                borderColor: 'rgba(249, 148, 23, 1)',
                borderWidth: 2,
                borderRadius: 3
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
                annotation: {
                    annotations:
                        {
                            0: {
                                display: true,
                                type: 'line',
                                scaleID: 'y',
                                label: {
                                    display: (ctx) => ctx.hovered,
                                    backgroundColor: 'rgba(56, 118, 191, .7)',
                                    drawTime: 'afterDatasetsDraw',
                                    content: ['Média: ' + {!! json_encode($techAvg) !!}['Inicial'].toFixed(2)],
                                    position: (ctx) => ctx.hoverPosition
                                },
                                enter(ctx, event) {
                                    ctx.hovered = true;
                                    ctx.hoverPosition = (event.x / ctx.chart.chartArea.width * 100) + '%';
                                    ctx.chart.update();
                                },
                                leave(ctx, event) {
                                    ctx.hovered = false;
                                    ctx.chart.update();
                                },
                                value: {!! json_encode($techAvg) !!}['Inicial'],
                                borderColor: 'rgba(56, 118, 191, .4)',
                                borderWidth: 4,
                                drawTime: 'beforeDatasetsDraw',
                                options: {
                                    z: 10
                                }
                            },
                            1: {
                                display: true,
                                type: 'line',
                                scaleID: 'y',
                                label: {
                                    display: (ctx) => ctx.hovered,
                                    backgroundColor: 'rgba(249, 148, 23, .7)',
                                    drawTime: 'afterDatasetsDraw',
                                    content: ['Média: ' + {!! json_encode($psychAvg) !!}['Inicial'].toFixed(2)],
                                    position: (ctx) => ctx.hoverPosition
                                },
                                enter(ctx, event) {
                                    ctx.hovered = true;
                                    ctx.hoverPosition = (event.x / ctx.chart.chartArea.width * 100) + '%';
                                    ctx.chart.update();
                                },
                                leave(ctx, event) {
                                    ctx.hovered = false;
                                    ctx.chart.update();
                                },
                                value: {!! json_encode($psychAvg) !!}['Inicial'],
                                borderColor: 'rgba(249, 148, 23, .4)',
                                borderWidth: 4,
                                drawTime: 'beforeDatasetsDraw',
                                options: {
                                    z: 10
                                }
                            }
                        }

                }
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
    var gradeChart = new Chart(
        document.getElementById('classroomChart').getContext('2d'),
        configs
    )

</script>
