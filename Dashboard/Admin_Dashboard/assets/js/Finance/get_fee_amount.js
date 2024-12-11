$(document).ready(function() {
    // Fetch data from the PHP backend
    $.ajax({
        url: '../php/Finance/fee_data.php', 
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var totalPaid = data.fees.Paid || 0;
            var totalPending = data.fees.Pending || 0;

            var ctx = document.getElementById('feechartt').getContext('2d');

            // Create the pie chart
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Paid', 'Pending'],
                    datasets: [{
                        data: [totalPaid, totalPending],
                        backgroundColor: ['#28a745', '#dc3545'],
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
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': RS ' + tooltipItem.raw.toLocaleString();
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            labels: { font: { size: 14, weight: 'bold' } }
                        },
                        datalabels: {
                            color: '#fff',
                            font: { weight: 'bold', size: 16 },
                            formatter: function(value, context) {
                                var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                var percentage = ((value / total) * 100).toFixed(2);
                                return `${percentage}%\nRS ${value.toLocaleString()}`;
                            }
                        }
                    },
                    animation: { animateRotate: true, animateScale: true }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("Error fetching data: " + error);
        }
    });
});
