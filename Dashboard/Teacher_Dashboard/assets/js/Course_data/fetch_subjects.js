$(document).ready(function () {
    $('#courseSelect, #semesterSelect').change(function () {
        var courseCode = $('#courseSelect').val();
        var semester = $('#semesterSelect').val();

        if (courseCode && semester) {
            $.ajax({
                url: 'Teacher_php/fetch_subjects.php',
                method: 'GET',
                data: { course_code: courseCode, semester: semester },
                dataType: 'json',
                success: function (data) {
                    var subjectsTableBody = $('#subjectsTableBody');
                    subjectsTableBody.empty();

                    if (data.success) {
                        $.each(data.subjects, function (index, subject) {
                            var row = `
                                <tr>
                                    <td>${subject.subject_code}</td>
                                    <td>${subject.subject_name}</td>
                                    <td>${subject.credits}</td>
                                    <td>${subject.syllabus_status}</td>
                                </tr>
                            `;
                            subjectsTableBody.append(row);
                        });
                    } else {
                        subjectsTableBody.append('<tr><td colspan="4">No subjects found for the selected course and semester.</td></tr>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching subjects:', error);
                }
            });
        } else {
            $('#subjectsTableBody').empty();
        }
    });

    function fetchCourses() {
        $.ajax({
            url: 'Teacher_php/fetch_courses_data.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var courseSelect = $('#courseSelect');
                courseSelect.empty();
                courseSelect.append('<option value="">Select Course</option>');

                $.each(data.courses, function (index, course) {
                    courseSelect.append(`<option value="${course.course_code}">${course.course_name}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching courses:', error);
            }
        });
    }

  
    fetchCourses();
});
