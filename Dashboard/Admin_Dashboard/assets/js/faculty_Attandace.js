$(document).ready(function () {
    $("#attendanceForm").submit(function (e) {
        e.preventDefault();  
        var formData = $(this).serialize();
        $.ajax({
            url: '../php/faculty_attendance.php',  
            type: 'POST',
            data: formData,
            dataType: 'json',  
            success: function (response) {
                if (response.success) {
                   
                    alert(response.success);
                    location.reload();
                    $('#attendanceForm')[0].reset(); 
                } else if (response.error) {
                    
                    alert(response.error);  
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error);  
                alert("An error occurred while marking attendance.");
            }
        });
    });
});
