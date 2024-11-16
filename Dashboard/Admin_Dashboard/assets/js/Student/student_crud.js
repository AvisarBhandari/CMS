$(document).ready(function () {
    $('#studentForm').on('submit', function (e) {
        e.preventDefault(); 
        var formData = {
            student_roll: $('#student_roll').val(),
            student_name: $('#student_name').val(),
            gender: $('#gender').val(),
            email: $('#email').val(),
            department: $('#department').val(),
            course: $('#course').val(),
            phone_no: $('#phone_no').val(),
            semester: $('#semester').val(),
            dob: $('#dob').val(),
            admission_date: $('#admission_date').val(),
            parent_name: $('#parent_name').val(),
            address: $('#address').val(),
            edit_mode: $('#edit_mode').val(), // 'add' or 'edit'
            student_id_hidden: $('#student_id_hidden').val() // Student ID for editing
        };

        console.log("Form Data:", formData);
        var url = formData.edit_mode === 'edit'
            ? '../php/student/update_student.php'
            : '../php/student/insert_student.php';
        console.log("URL for AJAX request:", url);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log("Server Response:", response);

                if (response.status === 'success') {
                    var message =
                        formData.edit_mode === 'edit'
                            ? 'Student updated successfully!'
                            : 'Student added successfully!';
                    alert(message);

                    
                    window.location.reload();

                    // Reset form and switch back to 'add' mode
                    $('#studentForm')[0].reset();
                    $('#edit_mode').val('add'); // Reset form mode to 'add'
                    $('#student_id_hidden').val(''); // Clear student ID hidden field
                } else {
                    if (Array.isArray(response.message)) {
                        alert("Errors:\n" + response.message.join("\n"));
                    } else {
                        alert("Error: " + response.message);
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    alert("Error: " + xhr.responseJSON.message);
                } else {
                    alert("An error occurred while submitting the form.");
                }
            }
        });
    });
});


function fetchStudents() {
    console.log('Fetching student data...');
    $.ajax({
        url: "../php/student/fetch_student_data_display.php", 
        method: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                let dataHtml = "";
                $.each(response.data, function (index, student) {
                    dataHtml += `
                        <tr>
                            <td>${student.student_roll}</td>
                            <td>${student.student_name}</td>
                            <td>${student.gender}</td>
                            <td>${student.email}</td>
                            <td>${student.department_name}</td>
                            <td>${student.course_code}</td>
                            <td>${student.phone_no}</td>
                            <td>${student.semester}</td>
                            <td>${student.dob}</td>
                            <td>${student.admission_date}</td>
                            <td>${student.parent_name}</td>
                            <td>${student.address}</td>
                            <td>
                                <a href="#" onclick="editStudent('${student.student_roll}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning" style="font-size: 27px;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                </a>
                                <a href="#" onclick="deleteStudent('${student.student_roll}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger" style="font-size: 29px;">
                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                        <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    `;
                });
                $("#studentTable").html(dataHtml);
            } else {
                alert(response.message || "An error occurred while fetching student data.");
            }
        },
        error: function (xhr, status, error) {
            console.log("Error fetching data:", status, error);
            alert("An error occurred while fetching student data.");
        }
    });
}

fetchStudents();

window.editStudent = function (rollNo) {
    console.log("Editing student with Roll No:", rollNo);
    if (event) {
        event.preventDefault();
    }
    
 
    $.ajax({
        url: "../php/student/get_student_data.php", 
        method: "POST",
        data: { roll_no: rollNo }, 
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                const student = response.data;

                $("#student_roll").val(student.student_roll); 
                $("#student_name").val(student.student_name);
                $("#gender").val(student.gender);
                $("#email").val(student.email);
                $("#department").val(student.department_name); // Set department field
                
                // Trigger the department change event to load courses
                $('#department').trigger('change');

                $("#phone_no").val(student.phone_no);
                $("#semester").val(student.semester); 
                $("#dob").val(student.dob);
                $("#admission_date").val(student.admission_date);
                $("#parent_name").val(student.parent_name);
                $("#address").val(student.address);

                // Set the form to edit mode
                $("#edit_mode").val("edit");
                $("#student_id_hidden").val(student.student_id); 

                $('#course').val(student.course_code); 
                $('#course').trigger('change'); 

           
                $('#dropdownbtn').text('Update Student');
                $('#submit_button').val('Update Student');

              
                $('#studentDropdownButton').dropdown('toggle');
                $('#studentDropdownButton').next('.dropdown-menu').addClass('show');

            } else {
                alert(response.message || "Failed to load student data.");
            }
        },
        error: function (xhr, status, error) {
            console.log("Error fetching student data:", status, error);
            alert("An error occurred while loading student data.");
        }
    });
};

window.deleteStudent = function (studentRoll) {
    console.log("Deleting student with Roll No:", studentRoll);  

    if (confirm("Are you sure you want to delete this student?")) {
        $.ajax({
            url: "../php/student/delete_student.php",
            method: "POST",
            data: { student_roll: studentRoll },
            dataType: "json",
            success: function (response) {
                console.log("Response from PHP:", response);  
                if (response.status === 'success') {
                    alert(response.message);  
                    fetchData();  
                } else {
                    alert(response.message);  
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", status, error);  
                console.log("Error response:", xhr.responseText); 
                alert("An error occurred while trying to delete the student.");
            }
        });
    }
};
