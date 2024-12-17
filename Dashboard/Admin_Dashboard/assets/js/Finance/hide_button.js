document.getElementById('hideSalaryList').addEventListener('click', function () {
    var tableBody = document.getElementById('faculty_salary_body');
    var button = document.getElementById('hideSalaryList');

    // Toggle the visibility of the table rows
    if (tableBody.style.display === 'none') {
        tableBody.style.display = 'table-row-group'; // Show the table body
        button.textContent = 'Hide Data'; // Change button text to 'Hide Data'
    } else {
        tableBody.style.display = 'none'; // Hide the table body
        button.textContent = 'Show Data'; // Change button text to 'Show Data'
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Your existing script goes here
    document.getElementById('toggleFeeDataBtn').addEventListener('click', function() {
        var tableBody = document.getElementById('feeTableBody');
        var button = document.getElementById('toggleFeeDataBtn');

        if (tableBody.style.display === 'none') {
            tableBody.style.display = 'table-row-group';
            button.textContent = 'Hide Data';
        } else {
            tableBody.style.display = 'none';
            button.textContent = 'Show Data';
        }
    });
});