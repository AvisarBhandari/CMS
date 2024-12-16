$(document).ready(function () {
    $.ajax({
        url: 'Teacher_php/get_faculty_department.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                var department = data.department;
                $.ajax({
                    url: 'Teacher_php/get_courses_by_department.php',
                    method: 'GET',
                    data: { department: department },
                    dataType: 'json',
                    success: function (coursesData) {
                        if (coursesData.success) {
                            $('#course_select').empty();
                            $('#course_select').append('<option value="">Select Course</option>');
                            coursesData.courses.forEach(function (course) {
                                $('#course_select').append(
                                    `<option value="${course.course_code}">${course.course_name}</option>`
                                );
                            });
                        }
                    },
                    error: function () {
                        $('#course_select').append('<option value="">Error fetching courses</option>');
                    }
                });
            }
        },
        error: function () {
            $('#course_select').append('<option value="">Error fetching faculty department</option>');
        }
    });

    $('#course_select').change(function () {
        var course_code = $(this).val(); 

        if (!course_code) {
            $('#students_table').hide(); 
            return;
        }

        $.ajax({
            url: 'Teacher_php/get_students_by_course.php',
            method: 'GET',
            data: { course_code: course_code, _: new Date().getTime() },
            success: function (response) {
                $('#students_table').show();
                $('#students_table tbody').html(response);
            },
            error: function (xhr, status, error) {
                $('#students_table').hide();
            }
        });
    });
});
