
$(document).ready(function() {
    $('#courseForm').on('submit', function(e) {
        e.preventDefault(); 

        var formData = {
            course_code: $('#course_code').val(), 
            course_name: $('#course_name').val(),
            department: $('#department_dropdown').val(),
            credits: $('#credits').val(),
            semester: $('#sem').val(),
            course_status: $('input[name="course_status"]:checked').val(),
            edit_mode: $('#edit_mode').val(),  // either 'edit' or 'add'
        };

        var url = formData.edit_mode === 'edit' ? '../php/course/update_course.php' : '../php/course/insert_course.php';

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',  
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.reload();  
                    $('#courseForm')[0].reset();  
                    $('#submit_button').val('Add Course');
                    $('#edit_mode').val('add');
                } else {
                    alert('Error: ' + response.message);  
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error Status:', status);
                console.error('AJAX Error:', error);
                alert('An error occurred while submitting the form.');
            }
        });
    });
});




function fetchCourses() {
    console.log('Fetching course data...');
    $.ajax({
        url: "../php/course/fetch_course_data_display.php",  
        method: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                let dataHtml = "";
                $.each(response.data, function (index, course) {
                    
                    let department = course.department_name || "Not Available";  
                    dataHtml += `
                        <tr>
                            <td>${course.course_code}</td>
                            <td>${course.course_name}</td>
                            <td>${department}</td>
                            <td>${course.credits}</td>
                            <td>${course.semester}</td>
                            <td>${course.status}</td>
                            <td>
                                <a href="#" onclick="editCourse('${course.course_code}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning" style="font-size: 27px;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                </a>
                                <a href="#" onclick="deleteCourse('${course.course_code}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger" style="font-size: 29px;">
                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                        <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    `;
                });
                $("#course_table_body").html(dataHtml); 
            } else {
                alert(response.message || "An error occurred while fetching course data.");
            }
        },
        error: function (xhr, status, error) {
            console.log("Error fetching data:", status, error);
            alert("An error occurred while fetching course data.");
        }
    });
}


fetchCourses();


window.deleteCourse = function (courseCode) {
    console.log("Deleting course with Code:", courseCode);
    
    if (confirm("Are you sure you want to delete this course?")) {
        $.ajax({
            url: "../php/course/delete_course.php",  
            method: "POST",
            data: { course_code: courseCode },  
            dataType: "json",
            success: function (response) {
                console.log("Delete response:", response);
                if (response.status === 'success') {
                    alert(response.message);  
                    fetchCourses();  
                } else {
                    alert(response.message);  
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", status, error);
                alert("An error occurred while trying to delete the course.");
            }
        });
    }
};

window.editCourse = function (courseCode) {
    console.log("Editing course with Code:", courseCode);

    $.ajax({
        url: "../php/course/get_course_data.php", 
        method: "GET",
        data: { course_code: courseCode },  
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                // Fill form with course data
                $('#course_code').val(response.data.course_code);
                $('#course_name').val(response.data.course_name);
                $('#department_dropdown').val(response.data.department_name);
                $('#credits').val(response.data.credits);
                $('#sem').val(response.data.semester);
                $('input[name="course_status"][value="' + response.data.status + '"]').prop('checked', true);

                // Set hidden fields
                $('#course_id_hidden').val(response.data.course_code);
                $('#edit_mode').val('edit');

                // Change the form heading and button text
                $('#dropdownbtn').text('Update Course');
                $('#submit_button').val('Update Course');

               
                $('#courseDropdownButton').dropdown('toggle');  

             
                $('#courseDropdownButton').next('.dropdown-menu').addClass('show');

                
                $('#courseForm').show();
            } else {
                alert("Error fetching course data for editing.");
            }
        },
        error: function (xhr, status, error) {
            console.log("Error fetching course data:", error);
            alert("An error occurred while fetching data for editing.");
        }
    });
};
