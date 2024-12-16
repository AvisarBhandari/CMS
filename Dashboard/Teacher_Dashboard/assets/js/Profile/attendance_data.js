$(document).ready(function() {
   
    $.ajax({
        url: 'Teacher_php/attendance_data.php',  
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                var presentCount = data.present_count;
                var absentCount = data.absent_count;

                // Set up the chart data
                var chartData = {
                    labels: ['Present', 'Absent'],
                    datasets: [{
                        data: [presentCount, absentCount],
                        backgroundColor: ['#28a745', '#dc3545'], 
                        borderWidth: 1
                    }]
                };

               
                var ctx = document.getElementById('attendanceChart').getContext('2d');
                var attendanceChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: chartData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                alert(data.message); 
            }
        },
        error: function() {
            alert('Error fetching attendance data');
        }
    });
});