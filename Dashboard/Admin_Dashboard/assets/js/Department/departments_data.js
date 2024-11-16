$(document).ready(function () {
            
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
loadDepartments();
    });