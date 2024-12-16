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
                        } else {
                            console.log(coursesData.message || 'No courses found for this department');
                        }
                    },
                    error: function () {
                        console.log('Error fetching courses');
                    }
                });
            } else {
                console.log(data.message || 'No department found for this faculty');
            }
        },
        error: function () {
            console.log('Error fetching faculty department');
        }
    });

   
    $('#course_select').change(function () {
        var course_code = $(this).val(); 

        if (!course_code) {
            console.log('Please select a valid course');
            $('#students_table').hide(); 
            return;
        }

        
        $.ajax({
            url: 'Teacher_php/get_students_by_course.php',
            method: 'GET',
            data: { course_code: course_code, _: new Date().getTime() },
            success: function (response) {
                console.log(response);
                $('#students_table').show();
                $('#students_table tbody').html(response);
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
                $('#students_table').hide();
            }
        });
    });
});
