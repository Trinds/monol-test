<canvas class="student-eval-chart"   id="barChart">

    
</canvas>

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
                backgroundColor: [
         
                    @foreach($studentEvaluations as $evaluation)
                        @if($evaluation->score >= 10)
                            'rgba(0, 255, 0, 0.2)',
                        @else
                            'rgba(255, 0, 0, 0.2)',
                        @endif
                    @endforeach
                ],
                borderColor: [
                    @foreach($studentEvaluations as $evaluation)
                        @if($evaluation->score >= 10)
                            'rgba(0, 255, 0, 1)',
                        @else
                            'rgba(255, 0, 0, 1)',
                        @endif
                    @endforeach
                ],
                borderWidth: 1
            }]
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
            }
        }
    });

</script>

