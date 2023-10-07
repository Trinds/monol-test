<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas class="classroom-eval-chart" id="barChart"></canvas>
<script>
    var ctx = document.getElementById('barChart').getContext('2d');

    var studentNames = [];
    var testLabels = [];
    var scores = [];

    @foreach ($classroom->students as $student)
        studentNames.push('{{$student->name}}');

        var studentTestLabels = [];
        var studentScores = [];

        @foreach ($student->evaluations as $evaluation)
            studentTestLabels.push('{{$evaluation->test->type->type}}');
            studentScores.push({{$evaluation->score}});
        @endforeach

        testLabels.push(studentTestLabels);
        scores.push(studentScores);
    @endforeach

    var datasets = [];
    for (var i = 0; i < studentNames.length; i++) {
        datasets.push({
            label: studentNames[i],
            data: scores[i],
            backgroundColor: scores[i].map(score => (score >= 10) ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)'),
            borderColor: scores[i].map(score => (score >= 10) ? 'rgba(0, 255, 0, 1)' : 'rgba(255, 0, 0, 1)'),
            borderWidth: 1
        });
    }

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: testLabels[0], 
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
                        title: function(tooltipItem) {
                            // Display the test type when hovering over the bars
                            return testLabels[tooltipItem[0].datasetIndex][tooltipItem[0].index];
                        },
                        label: function(tooltipItem) {
                            // Display the student's name and score
                            return studentNames[tooltipItem.datasetIndex] + ': Nota - ' + tooltipItem.formattedValue;
                        }
                    }
                }
            }
        }
    });
</script>
