<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<canvas class="classroom_chart" id="barChart"></canvas>
<?php
    $studentNames = [];
    $Tec1=[];
    $Tec2=[];
    $Tec3=[];
    $Psi1=[];
    $Psi2=[];
    $Psi3=[];


    foreach ($classroom->students as $student) 
    {
        $studentNames[] = $student->name;

        foreach($student->evaluations as $evaluation)
        {  

            switch ($evaluation->test_id)
            {
                case 1:
                    $Tec1[]=$evaluation->score;
                break;
                case 2:
                    $Psi1[]=$evaluation->score;
                break;
                case 3:
                    $Tec2[]=$evaluation->score;
                break;
                case 4:
                    $Psi2[]=$evaluation->score;
                break;
                case 5:
                    $Tec3[]=$evaluation->score;
                break;
                case 6:
                    $Psi3[]=$evaluation->score;
                break;
            }                
        } 
    }



?><!-------------------------------------------------------------------------------~------------------------------><!------->

    <script>
           
        var studentNames = <?php echo json_encode($studentNames); ?>;
        var ctx = document.getElementById('barChart').getContext('2d');
        
        var datasets = 
        [

            {
                label: 'Tec1: ',
                data: <?php echo json_encode($Tec1); ?>,
                backgroundColor: 'blue',
                borderColor: 'blue',
                borderWidth: 1
            },
            {
                label: 'Tec2: ', 
                data: <?php echo json_encode($Tec2); ?>,
                backgroundColor: 'orange',
                borderColor: 'orange',
                borderWidth: 1,
            },            
            {
                label: 'Tec3: ', 
                data: <?php echo json_encode($Tec3); ?>,
                backgroundColor: 'green',
                borderColor: 'green',
                borderWidth: 1,
            },           
            {
                label: 'Psi1: ', 
                data: <?php echo json_encode($Psi1); ?>,
                backgroundColor: 'pink',
                borderColor: 'pink',
                borderWidth: 1,
            },           
            {
                label: 'Psi2: ', 
                data: <?php echo json_encode($Psi2); ?>,
                backgroundColor: 'yellow',
                borderColor: 'yellow',
                borderWidth: 1,
            },           
            {
                label: 'Psi3: ', 
                data: <?php echo json_encode($Psi3); ?>,
                backgroundColor: 'grey',
                borderColor: 'grey',
                borderWidth: 1,
            }
        ];

       
        
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
                    }
                },
                plugins: 
                {
                    legend: 
                    {
                        display: true,
                        labels: 
                        {   
                            boxWidth:0,
                        }
                    },
                    title: 
                    {
                        display: true,
                        color: 'rgb(13, 18, 130)',
                        text: 'Médias de testes',
                        font: 
                        {
                            size: 14,
                        },
                    },
                    tooltip: 
                    {
                        backgroundColor: 'rgb(56, 118, 191)',
                        callbacks: {
                            label: (tooltipItem) => 
                            {
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
                                z: 1,
                                scaleID: 'y',
                                type: 'line',
                                borderWidth: 3,
                                mode: 'horizontal',
                                value: 0,
                                borderColor: 'rgb(48, 133, 195)',
                            },
                            {
                                z: 1,
                                type: 'line',
                                scaleID: 'y',
                                borderWidth: 3,
                                mode: 'horizontal',
                                value: 0,
                                borderColor: 'rgb(249, 148, 23)',
                            }
                        ],
                        drawTime: 'beforeDatasetsDraw',
                    },
                }
            }
        });
    </script>