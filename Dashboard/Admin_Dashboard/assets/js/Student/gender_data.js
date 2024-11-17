$(document).ready(function () {
    $.ajax({
        url: "../php/student/gender_distribution_data.php",
        type: "GET",
        success: function (response) {
            try {
                const data = JSON.parse(response);
                const labels = ['Male', 'Female', 'Other'];
                const dataset = labels.map(label => data[label.toLowerCase()] || 0);
                const ctx = document.getElementById('genderChart').getContext('2d');

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Gender Distribution',
                            backgroundColor: ['rgb(0,0,255)', 'rgb(255,105,180)', 'rgb(255,255,0)'],
                            borderColor: ['rgba(0,0,0,0.1)', 'rgba(0,0,0,0.1)', 'rgba(0,0,0,0.1)'],
                            data: dataset
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins: {
                            legend: { display: true, labels: { fontStyle: 'normal' } },
                            tooltip: { callbacks: { label: function (context) { return `${context.label}: ${context.raw} students`; } } }
                        },
                        title: { display: true, text: 'Enrollment Distribution by Gender', fontStyle: 'normal' }
                    }
                });
            } catch (error) {
                alert('Failed to load gender distribution data');
            }
        },
        error: function () {
            alert('Failed to load gender distribution data');
        }
    });
});
