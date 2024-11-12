fetchAbsenceData();

function fetchAbsenceData() {
    $.ajax({
        url: '../php/faculty_attendance_count.php', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                updateChart(response.data);
            } else {
                alert('Failed to load data');
            }
        },
        error: function(xhr, status, error) {
            alert('Error in fetching data');
        }
    });
}

function updateChart(data) {
    // Extract values for the 12 months and default to 0 if data is missing
    var monthsData = [];
    for (var i = 0; i < 12; i++) {
        monthsData.push(data[i] || 0);
    }

    // Validate the data (it should have exactly 12 months data)
    if (monthsData.length !== 12) {
        alert('Invalid data format received');
        return;
    }

    // Get the chart context
    var ctx = document.getElementById('absenceChart').getContext('2d');

    
    if (window.absenceChart instanceof Chart) {
        window.absenceChart.destroy();
    }

    // Create a gradient for the bar chart with a smooth transition between blue and purple
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#7b2ff7');  // Deep purple
    gradient.addColorStop(1, '#ff61a6');  // Light pink

    // Create the new chart instance
    window.absenceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Absent Teachers',
                backgroundColor: gradient,
                borderColor: 'rgba(255, 99, 132, 0.8)',
                borderWidth: 1,
                data: monthsData,
                hoverBackgroundColor: '#ff1e1e',  
                hoverBorderColor: '#d40000',  
                barThickness: 40,  
                borderRadius: 15,  
                hoverBorderWidth: 3  
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1000,  
                easing: 'easeInOutQuart' 
            },
            legend: {
                display: true,
                position: 'top',  // Place legend at the top for a clean look
                labels: {
                    fontStyle: 'bold',
                    fontColor: '#444',  
                    fontSize: 14
                }
            },
            title: {
                display: true,
                text: '',
                fontStyle: 'bold',
                fontSize: 18,
                fontColor: '#444',
                padding: 15,
                fontFamily: 'Arial, sans-serif'  
            },
            tooltips: {
                enabled: true,
                backgroundColor: '#333',
                titleFontSize: 14,
                bodyFontSize: 12,
                bodyFontColor: '#fff',
                cornerRadius: 4,  
                xPadding: 14,  
                yPadding: 12,  // Vertical padding for better spacing
                callbacks: {
                    label: function(tooltipItem) {
                        return 'Absent: ' + tooltipItem.yLabel;
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        fontStyle: 'normal',
                        fontColor: '#444',
                        fontSize: 13,
                        padding: 15,  
                    },
                    grid: {
                        color: '#e0e0e0',  
                        drawBorder: false  // Remove grid lines at the border for a cleaner look
                    }
                },
                y: {
                    beginAtZero: true,  
                    ticks: {
                        fontStyle: 'normal',
                        precision: 0,
                        fontColor: '#444',
                        fontSize: 12,
                        stepSize: 1,  // Define step size to make ticks more consistent
                        padding: 20 
                    },
                    grid: {
                        color: '#e0e0e0',  
                        drawBorder: false  
                    }
                }
            }
        }
    });
}
