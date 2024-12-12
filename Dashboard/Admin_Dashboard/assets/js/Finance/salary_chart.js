$(document).ready(function () {
    $.ajax({
        url: '../php/Finance/get_salary_data.php', 
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            var paid = parseFloat(data.paid) || 0;
            var unpaid = parseFloat(data.unpaid) || 0;
            var ctx = document.getElementById('salaryChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie', 
                data: {
                    labels: ['Paid Salary', 'Unpaid Salary'],
                    datasets: [{
                        data: [paid, unpaid],
                        backgroundColor: ['#007bff', '#ffc107'], 
                        hoverOffset: 6,
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return tooltipItem.label + ': Rs ' + tooltipItem.raw.toLocaleString();
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14,
                                    family: 'Arial, sans-serif',
                                    weight: 'bold'
                                },
                                padding: 15
                            }
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching salary data: " + error);
        }
    });
});
