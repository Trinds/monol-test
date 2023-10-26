<canvas id="myPieChart"></canvas>

<?php
$abbreviationArray = [];

foreach ($Turmas as $turma) {
    $abbreviationArray[] = $turma->course->abbreviation;
}

$abbreviationCounts = array_count_values($abbreviationArray);
?>

<script>
    var ctx = document.getElementById("myPieChart").getContext("2d");

    var labels = Object.keys({!! json_encode($abbreviationCounts, JSON_HEX_TAG) !!});
    var values = Object.values({!! json_encode($abbreviationCounts, JSON_HEX_TAG) !!});

    const backgroundColors =
        [
            'rgba(242, 147, 31, 1)',
            'rgba(25, 150, 208, 1)',
            'rgba(236, 118, 33, 1)',
            'rgba(130, 119, 78, 1)',
            'rgba(17, 90, 125, 1)',
            'rgba(21, 120, 167, 1)',
            'rgba(154, 83, 57, 1)',
            'rgba(229, 88, 35, 1)',
            'rgba(186, 133, 55, 1)',
            'rgba(78, 78, 78, 1)',
        ];

    var data =
        {
            labels: labels,
            datasets:
                [
                    {
                        data: values,
                        backgroundColor: backgroundColors.slice(0, labels.length),
                    },
                ],
        };

    var myPieChart = new Chart(ctx,
        {
            type: "pie",
            data: data,
            options:
                {
                    aspectRatio: 1,
                    responsive: true,
                    cutout: '65%',
                    plugins:
                        {
                            legend:
                                {
                                    display: true,
                                    position: 'right',
                                    maxWidth: 250,
                                    title:
                                        {
                                            display: true,
                                        },
                                    labels: {
                                        boxWidth: 25
                                    }
                                },
                        },
                },
        });
</script>

