$(document).ready(function() {
    
    function loadDepartments() {
        $.ajax({
            url: "../php/Department/get_department.php",  
            type: "GET",
            success: function(response) {
                try {
                    let departments = typeof response === 'string' ? JSON.parse(response) : response;
                    const $departmentDropdown = $('#department'); 
                    $departmentDropdown.empty();
                    $departmentDropdown.append('<option value="">Select Department</option>');

                    departments.forEach(function(department) {
                        const option = `<option value="${department.name}">${department.name}</option>`;
                        $departmentDropdown.append(option);
                    });

                } catch (error) {
                    console.error('Error parsing JSON:', error, response);
                    alert('Failed to load departments');
                }
            },
            error: function() {
                alert('Error loading departments');
            }
        });
    }

    $('#department').change(function() {
        const departmentName = $(this).val(); 

        if (departmentName) {
            $.ajax({
                url: "../php/course/course_options.php",  
                type: "GET",
                data: { department_name: departmentName },
                success: function(response) {
                    try {
                        const courseDropdown = $('#course'); 
                        const courseTypeDropdown = $('#course_type');

                        courseDropdown.empty();  
                        courseTypeDropdown.empty();  

                        if (response.length > 0) {
                            courseDropdown.append('<option value="">Select Course</option>');
                            response.forEach(function(course) {
                                courseDropdown.append(`<option value="${course.course_code}">${course.course_name}</option>`);
                            });
                        } else {
                            courseDropdown.append('<option value="">No courses available</option>');
                        }
                    } catch (error) {
                        console.error('Error parsing courses response:', error, response);
                    }
                },
                error: function() {
                    console.error('Error fetching courses');
                }
            });
        }
    });
    loadDepartments();
});
