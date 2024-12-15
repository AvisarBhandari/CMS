document.addEventListener('DOMContentLoaded', function() {
    fetchAttendanceData();
});

function fetchAttendanceData() {
    fetch('Student_php/student_attendance_data.php')
        .then(response => response.json())
        .then(data => {
            console.log('Fetched data:', data);

            if (data.success) {
                // Extract data
                const presentCount = data.present_count;
                const absentCount = data.absent_count;

                // Create Donut Chart
                const ctx = document.getElementById('attendanceDonutChart').getContext('2d');
                const attendanceDonutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Present', 'Absent'],
                        datasets: [{
                            data: [presentCount, absentCount],
                            backgroundColor: ['#28a745', '#dc3545'],
                            borderColor: ['#218838', '#c82333'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                enabled: true
                            },
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 14
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                alert(data.message || 'Error fetching attendance data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while fetching attendance data.');
        });
}
