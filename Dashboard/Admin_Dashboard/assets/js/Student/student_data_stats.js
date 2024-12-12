document.addEventListener("DOMContentLoaded", function () {
    fetch('../php/student/student_data_stats.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total_students').innerText = data.total_students;
            document.getElementById('total_attendance').innerText = data.total_attendance;
            document.getElementById('absent_students').innerText = data.absent_students;
            document.getElementById('total_enrollments').innerText = data.total_enrollments;
        });
});