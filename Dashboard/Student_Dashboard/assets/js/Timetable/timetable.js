document.getElementById('fetchTimetable').addEventListener('click', function () {
    const day = document.getElementById('day').value;
    const semester = document.getElementById('semester').value;

    if (!day || !semester) {
        alert('Please select both a day and a semester.');
        return;
    }

    // Log the selected day and semester for debugging
    console.log('Fetching timetable for Day:', day, 'Semester:', semester);

    fetch('Student_php/fetch_student_timetable.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ day, semester }),
    })
        .then((response) => response.json())
        .then((data) => {
            const timetableBody = document.getElementById('timetableBody');
            timetableBody.innerHTML = ''; // Clear existing rows

            if (data.success) {
                console.log('Timetable fetched:', data.timetable);  // Log the fetched timetable data

                data.timetable.forEach((entry) => {
                    // Convert start_time and end_time to 12-hour format
                    const start_time = convertTo12HourFormat(entry.start_time);
                    const end_time = convertTo12HourFormat(entry.end_time);

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${entry.subject_name}</td>
                        <td>${start_time}</td>
                        <td>${end_time}</td>
                        <td>${entry.faculty_name}</td>
                    `;
                    timetableBody.appendChild(row);
                });

                document.getElementById('timetableDisplay').style.display = 'block';
            } else {
                alert(data.message || 'No timetable found.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('An error occurred while fetching the timetable.');
        });
});

// Function to convert 24-hour time to 12-hour format
function convertTo12HourFormat(time) {
    const [hours, minutes] = time.split(':');
    let hour = parseInt(hours, 10);
    const period = hour >= 12 ? 'PM' : 'AM';
    hour = hour % 12 || 12; // Converts 0 to 12 (midnight)
    const minute = minutes.padStart(2, '0'); // Adds leading zero to minutes if needed
    return `${hour}:${minute} ${period}`;
}
