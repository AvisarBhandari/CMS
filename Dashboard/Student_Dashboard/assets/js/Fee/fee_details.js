document.addEventListener('DOMContentLoaded', function() {
    const toggleTableBtn = document.getElementById('toggleTableBtn');
    const feeInstallmentTable = document.getElementById('feeInstallmentTable');
    const installmentDetails = document.getElementById('installmentDetails');

    toggleTableBtn.addEventListener('click', function() {
        // Toggle the visibility of the table
        if (feeInstallmentTable.style.display === 'none') {
            feeInstallmentTable.style.display = 'block';
            fetchInstallmentData();
        } else {
            feeInstallmentTable.style.display = 'none';
        }
    });

    
    function fetchInstallmentData() {
        fetch('Student_php/fee_details.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    let html = '';
                    data.installments.forEach(installment => {
                        const paymentStatus = installment.payment_date ? installment.payment_date : 'Not Paid';

                        // Ensure proper formatting for amounts with the rupee sign
                        const formatCurrency = (amount) => `₹${parseFloat(amount).toFixed(2)}`;

                        html += `
                            <tr>
                                <td>${installment.installment_no}</td>
                                <td>${installment.due_date}</td>
                                <td>${installment.status}</td>
                                <td>${formatCurrency(installment.amount)}</td>
                                <td>${formatCurrency(installment.discount)}</td>
                                <td>${formatCurrency(installment.paid_amount)}</td>
                                <td>${paymentStatus}</td>
                            </tr>
                        `;
                    });
                    installmentDetails.innerHTML = html;
                } else {
                    installmentDetails.innerHTML = `<tr><td colspan="8" class="text-center">No data available</td></tr>`;
                }
            })
            .catch(error => {
                console.error('Error fetching installment data:', error);
                installmentDetails.innerHTML = `<tr><td colspan="8" class="text-center">Error fetching data</td></tr>`;
            });
    }
});
