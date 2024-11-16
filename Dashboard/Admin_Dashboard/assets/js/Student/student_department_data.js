document.addEventListener("DOMContentLoaded", () => {
    fetch("../php/student/student_department_data.php")
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                const ctx = document.getElementById("departmentEnrollmentChart").getContext("2d");
                new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: data.chartData.labels,
                        datasets: [{
                            label: "Department-wise Enrollments",
                            backgroundColor: ["rgb(30,122,109)", "rgb(249,232,20)", "rgb(78,115,223)", "rgb(231,74,59)", "rgb(90,92,105)"],
                            borderColor: "rgba(0,0,0,0.1)",
                            data: data.chartData.data
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    font: {
                                        style: "bold",
                                        size: 14
                                    },
                                    color: "#6777ef"
                                },
                                position: "bottom"
                            }
                        }
                    }
                });
            } else {
                alert("Error fetching chart data: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Failed to fetch enrollment data.");
        });
});
