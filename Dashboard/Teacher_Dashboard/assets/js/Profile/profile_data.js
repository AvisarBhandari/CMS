$(document).ready(function() {
    $.ajax({
        url: 'Teacher_php/get_faculty_info.php',  
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                $('#faculty_id').text(data.faculty_data.faculty_id); 
                $('#faculty_name').text(data.faculty_data.faculty_name);
                $('#position').text(data.faculty_data.position);
                $('#phone_number').text(data.faculty_data.phone_number);
                $('#department').text(data.faculty_data.department);
                $('#dob').text(data.faculty_data.dob);
                $('#start_date').text(data.faculty_data.start_date);
                $('#salary').text('₹' + data.faculty_data.salary);
                $('#address').text(data.faculty_data.address);
            } else {
                alert(data.message);  
            }
        },
        error: function() {
            alert('Error fetching faculty profile');
        }
    });
});
