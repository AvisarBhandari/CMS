$(document).ready(function () {
    // Load available courses when the page loads
    loadCourses();

    // Event handler for course selection or date change
    $('#course_select, #attendance_date').change(function () {
        var course_id = $('#course_select').val();
        var attendance_date = $('#attendance_date').val();

        if (course_id && attendance_date) {
            loadStudents(course_id, attendance_date, 'default');
        }
    });

    // Event handler for Edit Attendance button
    $('#editAttendance').click(function () {
        var course_id = $('#course_select').val();
        var attendance_date = $('#attendance_date').val();

        if (course_id && attendance_date) {
            loadStudents(course_id, attendance_date, 'edit');
            $('#addAttendance').hide();
            $('#updateAttendance').show();
        }
    });

    // Event handler for Add Attendance button
    $('#addAttendance').click(function () {
        saveAttendance('add');
    });

    // Event handler for Update Attendance button
    $('#updateAttendance').click(function () {
        saveAttendance('update');
    });
});

// Load available courses via AJAX
function loadCourses() {
    $.ajax({
        url: '../php/student/get_courses.php',
        method: 'GET',
        success: function (response) {
            var courses = JSON.parse(response);
            var courseSelect = $('#course_select');
            courseSelect.empty();
            courseSelect.append('<option value="">Select Course</option>');
            courses.forEach(function (course) {
                courseSelect.append('<option value="' + course.course_code + '">' + course.course_name + '</option>');
            });
        },
        error: function () {
            alert('Error while loading courses.');
        }
    });
}

// Load students based on selected course, date, and action (default/edit)
function loadStudents(course_id, attendance_date, action) {
    var url = (action === 'edit') ? '../php/student/get_student_attendance_edit.php' : '../php/student/get_students.php';

    $.ajax({
        url: url,
        method: 'GET',
        data: {
            course_id: course_id,
            attendance_date: attendance_date
        },
        success: function (response) {
            if (response.trim() === 'no_data') {
                $('#attendanceTable').empty();
                $('#noDataMessage').show(); 
                $('#editAttendance').hide(); 
            } else {
                $('#attendanceTable').html(response); // Populate the table with attendance data
                $('#noDataMessage').hide(); // Hide the message if data is available
                $('#editAttendance').show(); // Show the edit button if data is available
            }
        },
        error: function () {
            alert('Error while loading students.');
        }
    });
}

function saveAttendance(action) {
    var course_id = $('#course_select').val();
    var attendance_date = $('#attendance_date').val();
    var status = [];
    var student_rolls = [];

    // Collect attendance status from each student
    $('#attendanceTable .status').each(function () {
        status.push($(this).val());
        student_rolls.push($(this).closest('tr').find('.student_roll').text());
    });

    if (course_id && attendance_date && status.length > 0) {
        var url = (action === 'add') ? '../php/student/add_attendance.php' : '../php/student/update_attendance.php';

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                course_id: course_id,
                attendance_date: attendance_date,
                students: student_rolls.map(function(roll, index) {
                    return { student_roll: roll, status: status[index] };
                })
            },
            success: function (response) {
                console.log("Response from PHP:", response);  // Log for debugging
                var res = JSON.parse(response);
                // Use SweetAlert to display the response
                if (res.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: res.message
                    }).then(function() {
                        location.reload();
                    });
                    } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: res.message
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error while saving attendance.',
                });
                console.error("Error saving attendance");  // Log error for debugging
            }
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please select a course, date, and attendance status.',
        });
    }
}

