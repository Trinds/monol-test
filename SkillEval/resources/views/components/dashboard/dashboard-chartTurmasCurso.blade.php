<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.js"></script>
<canvas id="myPieChart"></canvas>


<?php
      $abbreviationArray = [];

      foreach ($Turmas as $turma) {
          $abbreviationArray[] = $turma->course->abbreviation;
      }

      $abbreviationJSON = json_encode($abbreviationArray);

      $abbreviationCounts = array_count_values($abbreviationArray);
      $abbreviationCountsJSON = json_encode($abbreviationCounts);
?>

<script>
      var ctx = document.getElementById("myPieChart").getContext("2d");

      var abbreviationCounts = <?php echo $abbreviationCountsJSON; ?>;

      var labels = Object.keys(abbreviationCounts);
      var values = Object.values(abbreviationCounts);

      var backgroundColors = 
      [
                    'rgb(237, 125, 49, 0.7)',
                    'rgb(25, 38, 85, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgb(148, 11, 146, 0.7)',
                    'rgb(238, 237, 237), 0.7'
      ];

      var data = {
        labels: labels,
        datasets: [
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
        options: {
          cutout: '70%', 
          plugins: {
            legend: {
              title: {
                display: true,
                text: 'Turmas Por Curso',
              },
            },
          },
        },
      });
</script>

