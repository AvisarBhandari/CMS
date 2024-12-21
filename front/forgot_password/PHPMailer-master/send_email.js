$(document).ready(function () {
    // Bind the function to a button click or other event
    $('#sendOtpButton').on('click', function () {
        // Get the email address from an input field (you can modify this if needed)
        var email = $('#emailInput').val();
        sendOtpEmail(email);
    });

    function sendOtpEmail(email) {
        // Generate OTP (6-digit random number)
        var otp = Math.floor(100000 + Math.random() * 900000);

        // Format the OTP email body content using HTML
        var emailSubject = "Your OTP Code";
        var emailBody = `
            <h2>Your One-Time Password (OTP)</h2>
            <p>Hello,</p>
            <p>Your OTP code for the requested action is:</p>
            <h3 style="color: #4CAF50;">${otp}</h3>
            <p>This OTP is valid for 10 minutes. Please use it as soon as possible.</p>
            <p>If you did not request this, please ignore this email.</p>
            <p>Thank you!</p>
        `;

        // Prepare the data to be sent in the AJAX request
        var formData = {
            email: email,
            subject: emailSubject,
            body: emailBody,
            otp: otp
        };

        // Alert before sending OTP
        alert('Sending OTP... Please wait.');

        // AJAX request to send the email with formatted content
        $.ajax({
            url: 'send_email.php', // Your PHP script for sending the email
            type: 'POST',
            data: formData,
            success: function (response) {
                alert(response);  // Show the response from the PHP script
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + error);  // Show error message
            }
        });
    }
});
