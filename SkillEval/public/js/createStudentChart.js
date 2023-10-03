// Updated data array with two columns for each month
const dataArray = [
    ['January', [10, 5]],
    ['February', [8, 3]],
    ['March', [9, 15]],
];

// Function to create the bar chart
function createBarChart(data) {
    const ctx = document.getElementById('barChart').getContext('2d');

    const labels = data.map(item => item[0]); // Extract month names
    const values1 = data.map(item => item[1][0]); // Extract the first value
    const values2 = data.map(item => item[1][1]); // Extract the second value

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Value 1', // Label for the first dataset
                    data: values1,
                    backgroundColor: 'rgb(233, 184, 36)', // Bar color for value 1
                    borderColor: 'rgb(216, 63, 49)', // Border color for value 1
                    borderWidth: 1, // Border width for value 1
                    barPercentage: 0.9,
                    categoryPercentage:0.3
                },
                {
                    label: 'Value 2', // Label for the second dataset
                    data: values2,
                    backgroundColor: 'rgb(63, 120, 216)', // Bar color for value 2
                    borderColor: 'rgb(63, 120, 216)', // Border color for value 2
                    borderWidth: 1, // Border width for value 2
                    barPercentage: 0.9,
                    categoryPercentage:0.3
                },
            ],
        },
        options: {
            scales: {
                x: {
                    display: true, // Hide x-axis labels
                },
                y: {
                    display: true, // Hide y-axis labels
                    beginAtZero: true
                },
            },
            responsive:true,
            plugins: {
                legend: {
                    display: true, // Display the legend
                }
            },
            responsive: true,
        }
    });
}

// Call the function with your updated data array
createBarChart(dataArray);
