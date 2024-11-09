function fetchChartData() {
    fetch('../php/get_earning_data.php')
        .then(response => response.json())
        .then(data => {
            console.log('Data fetched:', data); // Log the data

            // Check if the data structure is valid
            if (data && data.months && data.earnings && data.expenditures) {
                const months = data.months;
                const earnings = data.earnings;
                const expenditures = data.expenditures;

                const ctx = document.querySelector('#earningsChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months, // Use months from the backend
                        datasets: [{
                            label: 'Earnings',
                            fill: true,
                            data: earnings, 
                            backgroundColor: 'rgba(78, 115, 223, 0.1)', 
                            borderColor: 'rgba(78, 115, 223, 1)', 
                            borderWidth: 3, 
                            lineTension: 0.4, 
                            pointStyle: 'circle', 
                            pointRadius: 6, 
                            pointBorderColor: 'rgba(78, 115, 223, 1)',
                            pointBackgroundColor: 'rgba(255, 255, 255, 1)'
                        }, {
                            label: 'Expenditures',
                            fill: true,
                            data: expenditures, // Dynamic expenditures data
                            backgroundColor: 'rgba(229, 5, 58, 0.1)', 
                            borderColor: 'rgba(229, 5, 58, 1)', 
                            borderWidth: 3, 
                            lineTension: 0.4, 
                            pointStyle: 'rectRot', // Rotated rectangle points
                            pointRadius: 6, 
                            pointBorderColor: 'rgba(229, 5, 58, 1)',
                            pointBackgroundColor: 'rgba(255, 255, 255, 1)' 
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgb(234, 236, 244)', // Light grid color for better visibility
                                    zeroLineColor: 'rgb(234, 236, 244)',
                                },
                                ticks: {
                                    color: '#858796', // Font color for x-axis ticks
                                    padding: 20,
                                    font: {
                                        weight: 'bold',
                                    }
                                }
                            },
                            y: {
                                grid: {
                                    color: 'rgb(234, 236, 244)', // Light grid color
                                    zeroLineColor: 'rgb(234, 236, 244)',
                                },
                                ticks: {
                                    color: '#858796', // Font color for y-axis ticks
                                    padding: 20,
                                    font: {
                                        weight: 'bold',
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    font: {
                                        weight: 'bold',
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.error('Data is not in the expected format.');
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Call the function to load chart data when the page loads
document.addEventListener('DOMContentLoaded', fetchChartData);
