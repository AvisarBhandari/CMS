$(document).ready(function() {
    // Function to load departments
    function loadDepartments() {
        $.ajax({
            url: '../php/course/course_options.php', // Correct URL
            type: 'GET',
            data: { action: 'get_departments' }, // Ensure action parameter is included
            success: function(response) {
                try {
                    // Check if the response is a string and parse it, otherwise use it directly
                    let departments = (typeof response === 'string') ? JSON.parse(response) : response;
                    const $departmentDropdown = $('#department');
                    $departmentDropdown.empty();
                    $departmentDropdown.append('<option value="">Select Department</option>');
                    departments.forEach(function(department) {
                        $departmentDropdown.append(`<option value="${department.name}">${department.name}</option>`);
                    });
                } catch (error) {
                    console.error('Error parsing department response:', error);
                    alert('Failed to parse departments');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading departments:', xhr.responseText);
                alert('Failed to load departments');
            }
        });
    }

    // Function to load courses based on the selected department
    function loadCourses(departmentName) {
        $.ajax({
            url: '../php/course/course_options.php', // Correct URL
            type: 'GET',
            data: { action: 'get_courses', department_name: departmentName }, // Ensure action and department_name are included
            success: function(response) {
                try {
                    // Check if the response is a string and parse it, otherwise use it directly
                    let courses = (typeof response === 'string') ? JSON.parse(response) : response;
                    const $courseDropdown = $('#course');
                    $courseDropdown.empty();
                    $courseDropdown.append('<option value="">Select Course</option>');
                    courses.forEach(function(course) {
                        $courseDropdown.append(`<option value="${course}">${course}</option>`);
                    });
                } catch (error) {
                    console.error('Error parsing courses response:', error);
                    alert('Failed to parse courses');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading courses:', xhr.responseText);
                alert('Failed to load courses');
            }
        });
    }

    // Function to load semester based on the selected course and department
    function loadSemester(courseName, departmentName) {
        $.ajax({
            url: '../php/course/course_options.php', // Correct URL
            type: 'GET',
            data: { action: 'get_semester', course_name: courseName, department_name: departmentName }, // Ensure action, course_name, and department_name are included
            success: function(response) {
                try {
                    // Check if the response is a string and parse it, otherwise use it directly
                    let semester = (typeof response === 'string') ? JSON.parse(response) : response;
                    if (semester.semester) {
                        $('#semester').val(semester.semester);
                    } else {
                        $('#semester').val('');
                    }
                } catch (error) {
                    console.error('Error parsing semester response:', error);
                    alert('Failed to parse semester');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading semester:', xhr.responseText);
                alert('Failed to load semester');
            }
        });
    }

    // Event listener for department change
    $('#department').change(function() {
        const departmentName = $(this).val();
        if (departmentName) {
            loadCourses(departmentName);
            $('#semester').val(''); // Reset semester field
        } else {
            $('#course').empty();
            $('#course').append('<option value="">Select Course</option>');
            $('#semester').val(''); // Reset semester field
        }
    });

    // Event listener for course change
    $('#course').change(function() {
        const courseName = $(this).val();
        const departmentName = $('#department').val();
        if (courseName && departmentName) {
            loadSemester(courseName, departmentName);
        } else {
            $('#semester').val('');
        }
    });

    // Initial load of departments
    loadDepartments();
});
