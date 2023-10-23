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
          cutout: '70%', 
          plugins: 
          {
            legend: 
            {
              display: true,
              position: 'right',
              title: 
              { 
                display: true,
                text: 'Turmas Por Curso',
              },
            },
          },
        },
      });
</script>

