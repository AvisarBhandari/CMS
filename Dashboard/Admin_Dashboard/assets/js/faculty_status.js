$(document).ready(function() {
    $.ajax({
        url: '..//php/fetch_faculty_status.php', // Path to your PHP file
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Ensure we have valid data before updating the chart
            if (response && typeof response.active !== 'undefined' && typeof response.on_leave !== 'undefined') {
                updateChart(response.active, response.on_leave);
            } else {
                console.error("Invalid data received:", response);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching data:", error);
        }
    });

    // Function to update the chart with new data
    function updateChart(activeCount, onLeaveCount) {
        const ctx = document.getElementById('facultyStatusChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'On Leave'],
                datasets: [{
                    label: 'Faculty Status',
                    backgroundColor: ['rgb(0,183,96)', '#f7e859'],
                    borderColor: ['rgba(0,0,0,0.1)', 'rgba(0,0,0,0.1)'],
                    data: [activeCount, onLeaveCount]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    labels: {
                        fontStyle: 'normal'
                    }
                },
                title: {
                    fontStyle: 'normal',
                    text: '',
                    display: true,
                    position: 'top'
                }
            }
        });
    }
});
