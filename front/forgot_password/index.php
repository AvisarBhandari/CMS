<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
</head>

<body>
    <section>
        <div id="multple-step-form-n" class="container overflow-hidden" style="margin-top: 0px;margin-bottom: 10px;padding-bottom: 300px;padding-top: 57px;height: 569px;">
            <div id="progress-bar-button" class="multisteps-form">
                <div class="row">
                    <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                        <div class="multisteps-form__progress" style="margin-left: 79px;margin-right: -366px;">
                            <a class="btn multisteps-form__progress-btn js-active" role="button" title="User Info">User Info</a>
                            <a class="btn multisteps-form__progress-btn" role="button" title="User Info">Verification</a>
                            <a class="btn multisteps-form__progress-btn" role="button" title="User Info">New Password</a></div>
                    </div>
                </div>
            </div>
            <div id="multistep-start-row" class="row">

                <div id="multistep-start-column" class="col-12 col-lg-8 m-auto">
                    <form id="main-form" class="multisteps-form__form">

<div id="single-form-next" class="multisteps-form__panel shadow p-4 rounded bg-white js-active"
    data-animation="scaleIn">
    <h3 class="text-center multisteps-form__title">User Info</h3>
    <div class="container">
        <div class="row" style="margin-top: 40px; margin-left: -9px;">
            <div class="col-md-6"><span class="fs-5">ID</span>
        </div>
            <div class="col-md-6"><span class="fs-5">Email</span>
        
    </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin-top: 15px; margin-bottom: 40px;">
            <div class="col-md-6">
                <input id="name" class="form-control multisteps-form__input" required type="text"
                    placeholder="Enter your ID" onblur="validateId()">
                <small class="id_Error" style="color:red;"></small>

            </div>
            <div class="col-md-6">
                <input id="email"  class="form-control multisteps-form__input" required type="email" placeholder="Enter your email" onblur="validateAddress()">
                <p class="address_Error"style="color:red;"></p>
            </div>
        </div>
    </div>

    <div id="form-content" class="multisteps-form__content">
        <div id="next-button" class="button-row d-flex mt-4">
            <button id="next-btn"  class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>






                        <div id="single-form-next-prev" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="text-center multisteps-form__title">Verification code</h3>
                            <div id="form-content-1" class="multisteps-form__content">
                                <span class="fs-6" style="margin-left: 220px;">Please Enter Your Verification code sended on :</span>
                                <div id="input-grp-double-1" class="form-row mt-4">
                                    <div class="col-12 col-sm-6">
                                    </div>
                                    <div class="col-12 col-sm-6 mt-4 mt-sm-0">

                                        <input class="form-control multisteps-form__input" type="number" id="verify-otp" placeholder="Verification code" style="margin-top: 50px;
                                        margin-left: 200px;">
                                        </div>
                                </div>
                                <div id="input-grp-single-1" class="form-row mt-4">
                                    
                                </div>
                                <div id="next-prev-buttons" class="button-row d-flex mt-4">
                                <button class="btn btn btn-danger js-btn-prev" type="button" title="Prev" style="margin-left: 60px;" onclick="goToPrevStep()">Back</button>
                                <button class="btn btn btn-primary ml-auto js-btn-next" type="button" title="Next" style="margin-left: 540px; " onclick="verifyOtp()" id="submit-otp-btn">Submit</button></div>
                            </div>
                        </div>





                        
                        <div id="single-form-next-prev-1" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="text-center multisteps-form__title">New Password</h3>
                            <div id="form-content-2" class="multisteps-form__content">
                                <div id="input-grp-double-2" class="form-row mt-4">
                                <div class="container">
                                    <div class="row" style="margin-top: 40px;margin-left: -9px;">
                                        <div class="col-md-6"><span class="fs-5">New Password</span></div>
                                        <div class="col-md-6"><span class="fs-5">Conform Password</span></div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row" style="margin-top: 15px;margin-bottom: 40px;">
                                        <div class="col-md-6">
                                            <input class="form-control multisteps-form__input" id="password" required type="password"placeholder="Enter your Password" onblur="validatePassword()">
                                            <p id="password_Error" style="color: red;"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control multisteps-form__input" id="password-conform" required type="password"placeholder="Conform your password" onblur="validateConfirmPassword()">
                                            <p id="cPassword_Error" style="color: red;"></p>
                                        </div>
                                    </div>
                                </div>

                                <div id="next-prev-buttons-1" class="button-row d-flex mt-4">
                                    <button class="btn btn btn-danger js-btn-prev" type="button" title="Prev" onclick="goToPrevStep();" style="margin-left: 60px;">Back</button>
                                    <button class="btn btn btn-primary ml-auto js-btn-next" type="button" title="Next" style="margin-left: 540px;" onclick="updatePassword()">Submit</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Multi-step-form-script.js"></script>


<script>
    $(document).ready(function () {
    // Handle next button click
    $('#next-btn').on('click', function (e) {
        e.preventDefault();  // Prevent form submission

        var name = $('#name').val();
        var email = $('#email').val();

        // Simple validation for empty fields
        if (!name || !email) {
            Swal.fire({
                title: 'An error occurred!',
                text: 'Name or email do not match our records.',
                icon: 'warning',
                confirmButtonText: 'ok'
            });
            return;
        }

        // AJAX request to check name and email in the database
        $.ajax({
            url: 'check_user.php',  // PHP script to check user in the database
            type: 'POST',
            data: { name: name, email: email },
            success: function (response) {
                if (response === 'match') {
                    // Name and email matched, generate OTP and send it
                    var otp = Math.floor(100000 + Math.random() * 900000);
                    sendOtpEmail(email, otp,name);  // Send OTP to the email
                } else {
                    Swal.fire({
                        title: 'An error occurred!',
                        text: 'Name or email do not match our records.',
                        icon: 'error',
                        confirmButtonText: 'ok'
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: 'An error occurred!',
                    text: error,
                    icon: 'error',
                    confirmButtonText: 'ok'
                });
            }
        });
    });
});

// Send OTP email
function sendOtpEmail(email, otp) {
    var name = $('#name').val();  // Get name from the input field
    var emailSubject = "Your OTP Code";
    var emailBody = `
        Your OTP code for the requested action is:



                            ${otp}
                            


        This OTP is valid for 10 minutes. Please use it as soon as possible.
        If you did not request this, please ignore this email.
        Thank you!
    `;

    // Prepare the data to be sent in the AJAX request
    var formData = {
        email: email,
        name: name,  // Send name as well
        subject: emailSubject,
        body: emailBody,
        otp: otp
    };

    // Show SweetAlert loading spinner while sending the OTP
    const swalLoading = Swal.fire({
        title: 'Loading...',
        text: 'Please wait a moment.',
        allowOutsideClick: false,  // Disable closing the alert by clicking outside
        didOpen: () => {
            Swal.showLoading();  // Show the loading spinner
        }
    });

    // Send OTP via AJAX request
    $.ajax({
        url: 'PHPMailer-master/send_otp.php', // Your PHP script for sending the email
        type: 'POST',
        data: formData,
        success: function (response) {
            // Close the loading alert after OTP has been sent successfully
            swalLoading.close();

           if (response === 'success') {
                // Save OTP in the session
                $.ajax({
                    url: 'save_otp_session.php', // PHP script to save OTP in the session
                    type: 'POST',
                    data: { otp: otp ,name:name, email: email },
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                title: 'OTP Sent!',
                                text: 'The OTP has been sent to your email. Please check your inbox.',
                                icon: 'success',
                                confirmButtonText: 'Proceed'
                            }).then(() => {
                                goToNextStep();  // Call the function to go to the next step
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an issue saving the OTP. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'Retry'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        swalLoading.close();
                        Swal.fire({
                            title: 'An Error Occurred',
                            text: 'Failed to save OTP. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an issue sending the OTP. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'Retry'
                });
            }
        },
        error: function (xhr, status, error) {
            swalLoading.close();
            Swal.fire({
                title: 'An Error Occurred',
                text: 'Failed to send OTP. Please try again later.',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        }
    });
}



// Function to verify the OTP
function verifyOtp() {
    var enteredOtp = document.getElementById('verify-otp').value;

    // AJAX request to verify OTP
    $.ajax({
        url: 'verify_otp.php',  // PHP script to verify the OTP
        type: 'POST',
        data: { otp: enteredOtp },
        success: function (response) {
            if (response === 'success') {
                Swal.fire({
                    title: 'Success!',
                    text: 'OTP verified successfully.',
                    icon: 'success',
                    confirmButtonText: 'Proceed'
                }).then(() => {
                    goToNextStep();  // Adjust to your next step logic
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Invalid OTP. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'Retry'
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'An error occurred!',
                text: error,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
}



    // Function to update the password after validating
    function updatePassword() {
        // Get the values from the password fields
        var password =document.getElementById('password').value;
        var confirmPassword =document.getElementById('password-conform').value;

        // Validate that both passwords match
        if (password !== confirmPassword) {
            Swal.fire({
                title: 'Error!',
                text: 'Passwords do not match. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;  // Exit the function if passwords don't match
        }

        // Validate that the password is not empty and meets criteria (optional)
        if (password === '') {
            Swal.fire({
                title: 'Error!',
                text: 'Please enter a password.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Optionally, you can add further password validation (length, special characters, etc.)

        // Show loading spinner while processing
        const swalLoading = Swal.fire({
            title: 'Processing...',
            text: 'Please wait a moment.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading(); // Show the loading spinner
            }
        });

        // AJAX request to update password
        $.ajax({
            url: 'update_password.php',  // PHP script to update the password
            type: 'POST',
            data: {
                password: password,  // New password
                action: 'update_password' // Action flag to identify the operation
            },
            success: function (response) {
                swalLoading.close();  // Close the loading spinner

                // Check if the password update was successful
                if (response === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your password has been updated.',
                        icon: 'success',
                        confirmButtonText: 'Proceed'
                    }).then(() => {
                        // Optionally, redirect or take further action
                        window.location.href = '../Login.php';  // Replace with your success page
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an issue updating your password. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'Retry'
                    });
                }
            },
            error: function (xhr, status, error) {
                swalLoading.close();
                Swal.fire({
                    title: 'An error occurred!',
                    text: error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }





    function validateId() {
    const idInput = document.getElementById("name");
    const idError = document.querySelector(".id_Error");
    const idPattern = /^(ADM|STU|TEA)-\d{4}-\d{4}$/; // ID format validation

    if (!idPattern.test(idInput.value)) {
        idError.textContent = "ID must be in the format: STU-1234-5678.";
        return false;
    } else {
        idError.textContent = "";
        return true;
    }
}

function validateAddress() {
    const email = document.getElementById("email");
    const emailError = document.querySelector(".address_Error");

    const emailValue = email.value.trim();
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailValue) {
        emailError.textContent = "Email is required.";
    } else if (!emailPattern.test(emailValue)) {
        emailError.textContent = "Please enter a valid email address.";
    } else {
        emailError.textContent = ""; // Clear error message if valid
    }
}

function validatePassword() {
    const passwordInput = document.getElementById("password");
    const passwordError = document.querySelector(".password_Error");

    if (passwordInput.value.length < 8) {
        passwordError.textContent = "Password must be at least 8 characters long.";
        return false;
    } else {
        passwordError.textContent = "";
        return true;
    }
}

// Validate Confirm Password
function validateConfirmPassword() {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("password-conform");
    const confirmPasswordError = document.querySelector(".cPassword_Error");

    if (confirmPasswordInput.value !== passwordInput.value) {
        confirmPasswordError.textContent = "Passwords do not match.";
        return false;
    } else {
        confirmPasswordError.textContent = "";
        return true;
    }
}


</script>

</body>

</html>