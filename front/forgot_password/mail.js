  $(document).ready(function () {
        $('#next-btn').on('click', function () {
            var name = $('#name').val();
            var email = $('#email').val();

            if (!name || !email) {
                alert('Please enter both name and email.');
                return;
            }

            // AJAX request to check name and email in the database
            $.ajax({
                url: 'check_user.php',  // PHP script to check user in the database
                type: 'POST',
                data: { name: name, email: email },
                success: function(response) {
                    if (response === 'match') {
                        // Name and email matched, generate OTP and send it
                        var otp = Math.floor(100000 + Math.random() * 900000);
                        sendOtpEmail(email);  // Send OTP to the email
                    } else {
                        // If no match found, show an error message
                        alert('Name or email do not match our records.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });
    });

