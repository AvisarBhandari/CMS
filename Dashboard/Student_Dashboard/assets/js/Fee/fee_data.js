document.addEventListener('DOMContentLoaded', function () {
    fetchFeeDetails();
});

function fetchFeeDetails() {
    fetch('Student_php/fee_data.php')  // PHP file to get the fee data
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Extract data
                const paidAmount = data.paid_amount;
                const discountAmount = data.discount_amount;
                const remainingAmount = data.remaining_amount;

                // Display the paid amount, discount, and remaining balance
                document.querySelector('#paidAmount').textContent = `RS. ${paidAmount}`;
                document.querySelector('#discountAmount').textContent = `RS. ${discountAmount}`;
                document.querySelector('#remainingAmount').textContent = `RS. ${remainingAmount}`;
            } else {
                alert(data.message || 'Error fetching fee details.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while fetching fee details.');
        });
}
