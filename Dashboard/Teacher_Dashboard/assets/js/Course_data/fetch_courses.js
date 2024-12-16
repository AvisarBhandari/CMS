$(document).ready(function() {
    fetchCourses();  

    function fetchCourses() {
        $.ajax({
            url: 'Teacher_php/fetch_courses.php',  
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var departmentName = response.department_name;
                    var courses = response.courses;
                    var courseList = $('.course-list');
                    courseList.empty();  

                
                    $('#dept_name').text(' (' + departmentName + ')');
                    $.each(courses, function(index, course) {
                        var row = `
                            <tr>
                                <td>${course.course_code}</td>
                                <td>${course.course_name}</td>
                                <td>${course.credits}</td>
                                <td>${course.course_type}</td>
                                <td>${course.status}</td>
                            </tr>
                        `;
                        courseList.append(row);
                    });
                } else {
                    $('.course-list').html('<tr><td colspan="5">No courses found.</td></tr>');
                    $('#dept_name').text('');  
                }
            },
            error: function() {
                console.error('Error fetching courses');
                $('.course-list').html('<tr><td colspan="5">Error loading courses.</td></tr>');
                $('#dept_name').text('');  
            }
        });
    }
});
