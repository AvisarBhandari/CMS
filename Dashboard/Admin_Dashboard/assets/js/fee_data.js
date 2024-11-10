// Fetch and render the fee chart data
function fetchChartData() {
    fetch('../php/fee_data.php')  // Make sure the correct path to fee_data.php is used
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();  // Parse the JSON response
        })
        .then(data => {
            console.log('Data fetched successfully:', data);

            // Check if data is correctly formatted
            if (data && data.labels && data.datasets) {
                const ctx = document.getElementById('feechart').getContext('2d');
                
                // Destroy existing chart if needed to avoid overlap
                if (window.feeChart) {
                    window.feeChart.destroy();
                }

                // Create a new pie chart with improved design
                window.feeChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Fees Breakdown',
                            data: data.datasets[0].data,  // Chart data (Paid, Due, Partially Paid)
                            backgroundColor: [
                                'rgba(30, 122, 109, 0.8)',   
                                'rgba(229, 5, 58, 0.8)',    
                                'rgba(249, 232, 20, 0.8)'    
                            ],
                            borderColor: [
                                'rgba(30, 122, 109, 0.85)',     
                                'rgba(229, 5, 58, 0.85)',      
                                'rgba(249, 232, 20, 0.85)'    
                            ],
                            borderWidth: 3,  
                            hoverBackgroundColor: [
                                'rgba(30, 122, 109, 0.9)',   
                                'rgba(229, 5, 58, 0.9)',    
                                'rgba(249, 232, 20, 0.9)'   
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',  
                                labels: {
                                    font: {
                                        size: 14,
                                        weight: 'bold',
                                    },
                                    color: '#333'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.7)',  // Dark background for tooltips
                                titleColor: '#ffffff',
                                bodyColor: '#ffffff',
                                borderColor: '#000',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(tooltipItem) {
                                        const label = data.labels[tooltipItem.dataIndex];
                                        const value = data.datasets[0].data[tooltipItem.dataIndex];
                                        return `${label}: ${value.toLocaleString()}`;
                                    }
                                }
                            }
                        },
                        animation: {
                            animateScale: true,   
                            animateRotate: true    
                        },
                        layout: {
                            padding: {
                                top: 20,   
                                bottom: 20
                            }
                        }
                    }
                });
            } else {
                console.error('Data is not in the expected format.');
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

// Call the function to load chart data when the page is ready
document.addEventListener('DOMContentLoaded', fetchChartData);
