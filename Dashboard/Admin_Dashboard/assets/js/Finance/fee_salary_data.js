$(document).ready(function() {
    $.ajax({
        url: '../php/Finance/fee_salary_data.php', 
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $(".fee-paid-count").text(data.fees.Paid);
            $(".fee-pending-count").text(data.fees.Pending);
            $(".salary-paid-count").text(data.salaries.paid);
            $(".salary-pending-count").text(data.salaries.unpaid);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching data: " + error);
        }
    });
});