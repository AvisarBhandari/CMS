window.onload = function () {
    fetch('../php/course/fetch_course_stats.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-courses').innerText = data.total_courses;
            document.getElementById('active-courses').innerText = data.active_courses;
            document.getElementById('inactive-courses').innerText = data.inactive_courses;
        })
        .catch(error => console.error('Error fetching data:', error));
};