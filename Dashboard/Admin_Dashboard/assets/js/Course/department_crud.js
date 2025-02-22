$(document).ready(function () {
   
    $("#toggleForm").click(function () {
        $("#departmentSection").slideToggle();
        $(this).text(
            $(this).text() === "+ Add Department" ? "Hide Form" : "+ Add Department"
        );
    });

    
    function validateForm() {
        let nameRegex = /^[A-Za-z\s]{4,50}$/; 
        let descriptionRegex = /^[A-Za-z\s.]{10,200}$/; 

        let departmentName = $("#department_name").val().trim();
        let departmentDescription = $("#department_description").val().trim();
        let isValid = true;

        if (!nameRegex.test(departmentName)) {
            $("#nameError").text("Department Name must contain only letters and be 4-50 characters long.");
            isValid = false;
        } else {
            $("#nameError").text("");
        }

        if (!descriptionRegex.test(departmentDescription)) {
            $("#descriptionError").text("Description must contain only letters and be 10-200 characters long.");
            isValid = false;
        } else {
            $("#descriptionError").text("");
        }

        return isValid; 
    }

    
    $("#department_name, #department_description").on("input", validateForm);

    
    $("#departmentForm").on("submit", function (e) {
        e.preventDefault();

        if (!validateForm()) return; // Prevent submission if validation fails

        var formData = {
            department_name: $("#department_name").val(),
            department_description: $("#department_description").val(),
            edit_mode: $("#edit_mode").val(),
            department_id_hidden: $("#department_id_hidden").val(),
        };

        var url =
            $("#edit_mode").val() === "edit"
                ? "../php/Department/update_department.php"
                : "../php/Department/insert_department.php";

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    let action = $("#edit_mode").val() === "edit" ? "updated" : "added";
                
                    alert("Department successfully " + action + "!");
                    $("#departmentForm")[0].reset();
                    $("#submit_button").text("Add Department");
                    $("#edit_mode").val("add");
                    $("#department_id_hidden").val("");
                    $("#departmentSection").slideUp(); // Hide form after submit
                    fetchDepartments();
                } else {
                    $("#formError").text("Error: " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                $("#formError").text("An error occurred while submitting the form.");
            },
        });
    });

    // Fetch Departments
    function fetchDepartments() {
        $.ajax({
            url: "../php/Department/fetch_department.php",
            method: "GET",
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    let dataHtml = "";
                    $.each(response.data, function (index, department) {
                        dataHtml += `
                            <tr>
                                <td>${department.name || "N/A"}</td>
                                <td>${department.description || "N/A"}</td>
                                <td>
                                    <a href="#" onclick="editDepartment('${department.id}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" 
                                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" 
                                            class="icon icon-tabler icon-tabler-edit text-warning" style="font-size: 27px;">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 -2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="deleteDepartment('${department.id}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" 
                                            fill="currentColor" class="text-danger" style="font-size: 29px;">
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        `;
                    });
                    $("#department_table_body").html(dataHtml);
                } else {
                    $("#department_table_body").html(
                        '<tr><td colspan="3" class="text-center">No departments found.</td></tr>'
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", status, error);
                $("#formError").text("An error occurred while fetching departments.");
            },
        });
    }

    // Delete Department
    window.deleteDepartment = function (departmentId) {
        if (confirm("Are you sure you want to delete this department?")) {
            $.ajax({
                url: "../php/Department/delete_department.php",
                method: "POST",
                data: { department_id: departmentId },
                dataType: "json",
                success: function (response) {
                    fetchDepartments();
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    $("#formError").text("An error occurred while deleting the department.");
                },
            });
        }
    };

    // Edit Department
    window.editDepartment = function (departmentId) {
        $.ajax({
            url: "../php/Department/get_department_data.php",
            method: "GET",
            data: { department_id: departmentId },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("#department_name").val(response.data.name);
                    $("#department_description").val(response.data.description);
                    $("#department_id_hidden").val(response.data.id);
                    $("#submit_button").text("Update Department");
                    $("#edit_mode").val("edit");
                    $("#departmentSection").slideDown(); 
                    $("#toggleForm").text("Hide Form");
                } else {
                    $("#formError").text("Error fetching department data for editing.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching department data:", error);
                $("#formError").text("An error occurred while fetching data for editing.");
            },
        });
    };

    fetchDepartments();
});
