<div class="classroom-chart">
    <canvas class="classroom_chart" id="classroomChart"></canvas>
</div>
<div class="chart-options input-group-prepend">
    <select id="momentSelect" class="custom-select" onchange="momentScores(this)">
        <option value="Inicial">Inicial</option>
        <option value="Intermédio">Intermédio</option>
        <option value="Final">Final</option>
        <option selected value="Todos">Todos</option>
    </select>
    <input id="techCheck" type="checkbox" checked value="0" onclick="typeScores(this)"> Técnico
    <input id="psychCheck" type="checkbox" checked value="1" onclick="typeScores(this)"> Psicotécnico
    <input id="compareCheck" type="checkbox" value="1" onclick="comparativeMode(this)"> Modo Comparação

</div>
<script>

    const psychCheckEl = document.getElementById('psychCheck')
    const techCheckEl = document.getElementById('techCheck')
    const compareCheckEl = document.getElementById('compareCheck')
    const momentSelectEl = document.getElementById('momentSelect')

    function typeScores(type) {
        if (compareCheckEl.checked) {
            if (type.id === 'psychCheck') {
                techCheckEl.checked = false
                psychCheckEl.checked = true
                for (let i = 2; i <= 4; i++) {
                    gradeChart.hide(i)
                }
                for (let i = 5; i <= 7; i++) {
                    gradeChart.show(i)
                }
            } else {
                psychCheckEl.checked = false
                techCheckEl.checked = true
                for (let i = 2; i <= 4; i++) {
                    gradeChart.show(i)
                }
                for (let i = 5; i <= 7; i++) {
                    gradeChart.hide(i)
                }
            }
        } else {
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
        gradeChart.update()
    }

    function momentScores(moment) {
        gradeChart.config.options.parsing.yAxisKey = moment.value
        gradeChart.config.options.plugins.annotation.annotations[0].value = {!! json_encode($techAvg) !!}[moment.value]
        gradeChart.config.options.plugins.annotation.annotations[0].label.content = ['Média: ' + {!! json_encode($techAvg) !!}[moment.value].toFixed(2)]
        gradeChart.config.options.plugins.annotation.annotations[1].value = {!! json_encode($psychAvg) !!}[moment.value]
        gradeChart.config.options.plugins.annotation.annotations[1].label.content = ['Média: ' + {!! json_encode($psychAvg) !!}[moment.value].toFixed(2)]
        gradeChart.update()
    }

    function comparativeMode(toggle) {
        if (toggle.checked) {
            gradeChart.hide(0)
            gradeChart.hide(1)
            for (let i = 2; i <= 4; i++) {
                gradeChart.show(i)
            }
            gradeChart.config.options.parsing.yAxisKey = 'Moment'
            psychCheckEl.checked = false
            techCheckEl.checked = true
            momentSelectEl.disabled = true
            gradeChart.config.options.plugins.annotation.annotations[0].display = false
            gradeChart.config.options.plugins.annotation.annotations[1].display = false
        } else {
            for (let i = 2; i <= 7; i++) {
                gradeChart.isDatasetVisible(i) &&
                gradeChart.hide(i)
            }
            gradeChart.show(0)
            gradeChart.show(1)
            gradeChart.config.options.parsing.yAxisKey = 'Todos'
            psychCheckEl.checked = true
            techCheckEl.checked = true
            momentSelectEl.disabled = false
            momentSelectEl.value = 'Todos'
            gradeChart.config.options.plugins.annotation.annotations[0].display = true
            gradeChart.config.options.plugins.annotation.annotations[1].display = true

        }
        gradeChart.update()
    }

    let techInitial = []
    let techMed = []
    let techEnd = []
    let psychInitial = []
    let psychMed = []
    let psychEnd = []

    for (const item of {!! json_encode($classTechEval) !!}) {
        techInitial.push({'x': item['x'], 'Moment': item['Inicial']})
        techMed.push({'x': item['x'], 'Moment': item['Intermédio']})
        techEnd.push({'x': item['x'], 'Moment': item['Final']})
    }

    for (const item of {!! json_encode($classPsychoEval) !!}) {
        psychInitial.push({'x': item['x'], 'Moment': item['Inicial']})
        psychMed.push({'x': item['x'], 'Moment': item['Intermédio']})
        psychEnd.push({'x': item['x'], 'Moment': item['Final']})
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
            {
                label: 'Técnico Inicial',
                data: techInitial,
                backgroundColor: 'rgba(56, 118, 191, .7)',
                borderColor: 'rgba(56, 118, 191, 1)',
                borderWidth: 2,
                borderRadius: 3,
                display: false
            },
            {
                label: 'Técnico Intermédio',
                data: techMed,
                backgroundColor: 'rgba(56, 118, 191, .7)',
                borderColor: 'rgba(56, 118, 191, 1)',
                borderWidth: 2,
                borderRadius: 3,
                display: false
            },
            {
                label: 'Técnico Final',
                data: techEnd,
                backgroundColor: 'rgba(56, 118, 191, .7)',
                borderColor: 'rgba(56, 118, 191, 1)',
                borderWidth: 2,
                borderRadius: 3,
                display: false
            },
            {
                label: 'Psicotécnico Inicial',
                data: psychInitial,
                backgroundColor: 'rgba(249, 148, 23, .7)',
                borderColor: 'rgba(249, 148, 23, 1)',
                borderWidth: 2,
                borderRadius: 3,
                display: false
            },
            {
                label: 'Psicotécnico Intermédio',
                data: psychMed,
                backgroundColor: 'rgba(249, 148, 23, .7)',
                borderColor: 'rgba(249, 148, 23, 1)',
                borderWidth: 2,
                borderRadius: 3,
                display: false
            },
            {
                label: 'Psicotécnico Final',
                data: psychEnd,
                backgroundColor: 'rgba(249, 148, 23, .7)',
                borderColor: 'rgba(249, 148, 23, 1)',
                borderWidth: 2,
                borderRadius: 3,
                display: false
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
                    onClick: null,
                    labels: {
                        filter: item => item.text === 'Técnico' || item.text === 'Psicotécnico',
                        generateLabels: (gradeChart) => {
                            return gradeChart.data.datasets.map((dataset, index) => ({
                                text: dataset.label,
                                fillStyle: dataset.backgroundColor,
                                strokeStyle: dataset.borderColor,
                                fontColor: dataset.borderColor
                            })
                            )
                        }
                    }
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
                                    content: ['Média: ' + {!! json_encode($techAvg) !!}['Todos'].toFixed(2)],
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
                                value: {!! json_encode($techAvg) !!}['Todos'],
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
                                    content: ['Média: ' + {!! json_encode($psychAvg) !!}['Todos'].toFixed(2)],
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
                                value: {!! json_encode($psychAvg) !!}['Todos'],
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
    for (let i = 2; i <= 7; i++) {
        gradeChart.hide(i)
    }

</script>
