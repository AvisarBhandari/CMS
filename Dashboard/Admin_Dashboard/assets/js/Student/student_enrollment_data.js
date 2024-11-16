document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("enrollmentChart").getContext("2d");

    fetch('../php/student/student_enrollment_data.php')
        .then(response => response.json())
        .then(data => {
            if (data.status !== "success") throw new Error(data.message);

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, "rgba(78, 115, 223, 0.6)");
            gradient.addColorStop(1, "rgba(78, 115, 223, 0)");

            new Chart(ctx, {
                type: "line",
                data: {
                    labels: data.chartData.labels,
                    datasets: [{
                        label: "Student Enrollments",
                        fill: true,
                        data: data.chartData.data,
                        backgroundColor: gradient,
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 6,
                        pointRadius: 6,
                        borderWidth: 3.5,
                        tension: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            backgroundColor: "rgba(0, 0, 0, 0.85)",
                            titleFont: { size: 16, weight: "bold" },
                            bodyFont: { size: 16 },
                            callbacks: {
                                label: tooltipItem => `Enrollments: ${tooltipItem.raw.toLocaleString()}`
                            }
                        },
                        legend: {
                            position: "top",
                            labels: { color: "#6c757d", font: { size: 16, weight: "bold" } }
                        }
                    },
                    scales: {
                        x: {
                            ticks: { color: "#6c757d", font: { size: 14 }, padding: 25 },
                            grid: { color: "rgb(234, 236, 244)", borderDash: [5], drawOnChartArea: false }
                        },
                        y: {
                            ticks: { color: "#6c757d", font: { size: 14 }, padding: 25, callback: value => value.toLocaleString() },
                            grid: { color: "rgba(200, 200, 200, 0.2)", borderDash: [5] }
                        }
                    },
                    animation: { duration: 2000, easing: "easeInOutCubic" },
                    layout: { padding: 15 },
                    elements: { line: { capBezierPoints: true } }
                }
            });
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Failed to fetch enrollment data.");
        });
});
