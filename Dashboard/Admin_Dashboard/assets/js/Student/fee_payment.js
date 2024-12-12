$(document).ready(function() {
    $('#feeTableContainer').on('click', '.mark-as-pay', function() {
        var studentId = $(this).data('student_id');
        var installmentNo = $(this).data('installment_no');
        var amount = $(this).data('amount');
        var studentRoll = $(this).data('student_roll');
        var studentName = $(this).data('student_name');

        $('#studentRoll').val(studentRoll);
        $('#installmentNo').val(installmentNo);
        $('#amount').val(amount);
        $('#finalAmount').val(amount);

        $('#paymentModal').modal('show');
    });

    $.ajax({
        url: '../php/student/fetch_scholarships.php',
        type: 'GET',
        success: function(response) {
            var scholarships = JSON.parse(response);
            $('#scholarship').empty().append('<option value="0">None</option>');
            scholarships.forEach(function(scholarship) {
                $('#scholarship').append(
                    `<option value="${scholarship.discount_percentage}">${scholarship.name} (${scholarship.discount_percentage}% Scholarship)</option>`
                );
            });
        },
        error: function(xhr, status, error) {
            alert('Error fetching scholarship options: ' + error);
        }
    });

    $('#scholarship').on('change', function() {
        var amount = parseFloat($('#amount').val());
        var scholarship = parseInt($(this).val(), 10);

        if (!isNaN(scholarship) && scholarship >= 0) {
            var discountDecimal = scholarship / 100;
            var discountAmount = amount * discountDecimal;
            var finalAmount = amount - discountAmount;
            $('#finalAmount').val(finalAmount.toFixed(2));
        } else {
            $('#finalAmount').val(amount.toFixed(2));
        }
    });

    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();

        var studentRoll = $('#studentRoll').val();
        var installmentNo = $('#installmentNo').val();
        var finalAmount = $('#finalAmount').val();
        var scholarship = $('#scholarship').val();
        var amount = $('#amount').val();
        var discount = amount - finalAmount;
        var paymentDate = new Date().toISOString().slice(0, 19).replace("T", " ");

        $.ajax({
            url: '../php/student/get_student_id.php',
            type: 'POST',
            data: { student_roll: studentRoll },
            success: function(response) {
                var studentId = response.trim();
                
                if (!isNaN(studentId) && studentId > 0) {
                    $.ajax({
                        url: '../php/student/process_payment.php',
                        type: 'POST',
                        data: {
                            student_id: studentId,
                            installment_no: installmentNo,
                            status: 'paid',
                            amount: amount,
                            discount: discount,
                            paid_amount: finalAmount,
                            payment_date: paymentDate
                        },
                        success: function(response) {
                            $('#paymentModal').modal('hide');
                            alert('Payment recorded successfully!');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Error processing payment: ' + error);
                        }
                    });
                } else {
                    alert('Invalid student ID received.');
                }
            },
            error: function(xhr, status, error) {
                alert('Error fetching student_id: ' + error);
            }
        });
    });

    $('#feeTableContainer').on('click', '.unmark-as-pay', function() {
        var studentId = $(this).data('student_id');
        var installmentNo = $(this).data('installment_no');
        var amount = $(this).data('amount');

        $.ajax({
            url: '../php/student/unmark_pay.php',
            type: 'POST',
            data: {
                student_id: studentId,
                installment_no: installmentNo,
                status: 'pending',
                amount: amount
            },
            success: function(response) {
                if (response.includes("successfully")) {
                    alert('Payment unmarked successfully!');
                    location.reload();
                } else {
                    alert('Failed to unmark payment or no changes were made.');
                }
            },
            error: function(xhr, status, error) {
                alert('Error unmarking payment: ' + error);
            }
        });
    });
});
