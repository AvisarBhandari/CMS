$(document).ready(function () {
    function loadCourseEnrollment() {
        $.ajax({
            url: "../php/student/course_enrollment_data.php",
            type: "GET",
            success: function (response) {
                try {
                    const data = JSON.parse(response);
                    const labels = data.map(item => item.course_name);
                    const enrollmentData = data.map(item => item.enrollment_count);
                    
                    const ctx = document.getElementById('courseInrollmentChart').getContext('2d');
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(75, 192, 192, 0.8)');  
                    gradient.addColorStop(1, 'rgba(34, 193, 195, 0.8)'); 

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Enrollments',
                                backgroundColor: gradient,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                borderRadius: 10,
                                barThickness: 20,
                                data: enrollmentData
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: { 
                                legend: { display: false },
                                tooltip: {
                                    callbacks: { label: (context) => `Enrollments: ${context.raw}` },
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    cornerRadius: 5
                                }
                            },
                            scales: {
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        font: { size: 14 },
                                        color: '#333',
                                        autoSkip: false,
                                        maxRotation: 0,
                                        minRotation: 0
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    grid: { color: '#eaeaea' },
                                    ticks: { font: { size: 14 }, color: '#333', stepSize: 10 }
                                }
                            },
                            layout: { padding: { top: 20, bottom: 20 } }
                        }
                    });
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            },
            error: function () {
                alert('Failed to load course enrollment data');
            }
        });
    }

    loadCourseEnrollment();
});
