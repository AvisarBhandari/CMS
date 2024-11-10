$(document).ready(function () {
    $('#facultyForm').on('submit', function (e) {
        e.preventDefault(); // Prevent form from reloading the page

        // Serialize form data
        var formData = {
            faculty_id: $('#faculty_id').val(),
            faculty_name: $('#faculty_name').val(),
            position: $('#position').val(),
            address: $('#address').val(),
            dob: $('#dob').val(),
            start_date: $('#start_date').val(),
            salary: $('#salary').val(),
            phone_number: $('#phone_number').val()
        };

        // AJAX call to send form data to PHP script
        $.ajax({
            type: 'POST',
            url: '../php/insert_faculty_member.php', // PHP script to handle insertion
            data: formData,
            dataType: 'json',  // Expecting JSON response
            success: function (response) {
                if (response.status === 'success') {
                    alert('Faculty added successfully!');
                    $('#facultyForm')[0].reset(); // Reset form after success
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                // Log detailed error information
                console.error('AJAX Error Status: ' + status);
                console.error('AJAX Error: ' + error);
                console.error('Response Text: ' + xhr.responseText); // Log the response text
            }
        });
    });
});
