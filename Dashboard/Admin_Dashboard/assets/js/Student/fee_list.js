$(document).ready(function () {
    $('#generateFeeBtn').on('click', function () {
        $.ajax({
            url: '../php/student/generate_fee.php',  
            type: 'GET',
            success: function(response) {
               
                fetchFeeRecords();
            },
            error: function(xhr, status, error) {
                alert('Error generating fee: ' + error);
            }
        });
    });

    function fetchFeeRecords() {
        $.ajax({
            url: '../php/student/fetch_fees.php',  
            type: 'GET',
            success: function(response) {
                $('#feeTableBody').html(response);
            },
            error: function(xhr, status, error) {
                alert('Error fetching fee records: ' + error);
            }
        });
    }
});