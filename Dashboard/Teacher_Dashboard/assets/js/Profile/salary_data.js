$(document).ready(function() {
    // Fetch salary and payment status for the logged-in faculty
    $.ajax({
        url: 'Teacher_php/get_salary_status.php', // PHP file to fetch salary and payment status
        method: 'GET',
        dataType: 'json',
        success: function(salaryData) {
            if (salaryData.success) {
                var salary = salaryData.salary;  // salary from response
                var payment_status = salaryData.payment_status; // status from response
                var payment_percentage = (payment_status === 'Paid') ? 100 : 0;

                // Populate the salary and payment status dynamically
                $('#salary_amount').text('₹' + salary); // Ensure formatting for currency
                $('#payment_status').text(payment_status);

                // Change payment status text color based on status
                if (payment_status === 'Paid') {
                    $('#payment_status').removeClass('text-red').addClass('text-green');
                } else {
                    $('#payment_status').removeClass('text-green').addClass('text-red');
                }

                // Set the progress bar for salary payment status
                $('#salary_progress_bar').css('width', payment_percentage + '%');
            } else {
                console.log(salaryData.message); // If no data is found, log the message
            }
        },
        error: function() {
            console.log('Error fetching salary data');
        }
    });
});
