$(document).ready(function () {
    const form = document.getElementById('adminForm');

    // Validators Object
    const validators = {
        'admin_id': value => /^ADM-\d{4}-\d{4}$/.test(value) || "Admin ID must be in the format ADM-XXXX-XXXX.",
        'admin_name': value => /^[A-Za-z]{3,25}\s[A-Za-z]{3,25}$/.test(value) ||
            "Admin name must contain a first and last name, each between 3 and 25 characters, separated by a space.",
        'status': value => value !== "" || "You must select a status.",
        'address': value => value.trim() !== "" || "Address is required.",
        'dob': value => {
            const age = calculateAge(new Date(value));
            return (age >= 18 && age <= 60) || "Age must be between 18 and 60.";
        },
        'start_date': value => {
            const startDate = new Date(value);
            return (!isNaN(startDate.getTime()) && startDate <= new Date()) || "Start date cannot be in the future.";
        },
        'salary': value => {
            const salary = parseFloat(value);
            return (!isNaN(salary) && salary >= 5000 && salary <= 100000) || "Salary must be between 5,000 and 100,000.";
        },
        'phone_number': value => /^(98|97)\d{8}$/.test(value) || "Phone number must be valid and start with 97 or 98."
    };

    // Validate individual field
    function validateField(input) {
        if (validators[input.id]) {
            const validationMessage = validators[input.id](input.value);
            if (validationMessage !== true) {
                showError(input, validationMessage);
            } else {
                showSuccess(input);
            }
        }
    }

    // Validate entire form
    function validateForm() {
        let isValid = true;
        document.querySelectorAll("#adminForm input, #adminForm select").forEach(input => {
            validateField(input);
            if (input.classList.contains("is-invalid")) {
                isValid = false;
            }
        });
        return isValid;
    }

    // Calculate Age from D.O.B
    function calculateAge(birthDate) {
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    // Show Error
    function showError(input, message) {
        input.classList.add("is-invalid");
        input.classList.remove("is-valid");
        let errorElement = input.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains("invalid-feedback")) {
            errorElement = document.createElement("div");
            errorElement.classList.add("invalid-feedback");
            input.parentNode.appendChild(errorElement);
        }
        errorElement.textContent = message;
    }

    // Show Success
    function showSuccess(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        const errorElement = input.nextElementSibling;
        if (errorElement && errorElement.classList.contains("invalid-feedback")) {
            errorElement.remove();
        }
    }

    // Event Listeners for real-time validation
    form.addEventListener("input", function (event) {
        validateField(event.target);
    });

    // Form Submission Validation
    $('#adminForm').on('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        if (!validateForm()) {
            $('#responseMessage').html('<div class="alert alert-danger">Please fix the errors in the form.</div>');
            return;
        }

        // AJAX Request
        $.ajax({
            url: '../php/Faculty/insert_admin.php',
            type: 'POST',
            data: $('#adminForm').serialize(),
            success: function (response) {
                if (response === 'success') {
                    $('#responseMessage').html('<div class="alert alert-success">Admin added successfully!</div>');
                    $('#adminForm')[0].reset(); // Reset form fields
                    $('.is-valid').removeClass('is-valid'); // Remove success highlights
                } else {
                    $('#responseMessage').html('<div class="alert alert-danger">' + response + '</div>');
                }
            },
            error: function () {
                $('#responseMessage').html('<div class="alert alert-danger">An error occurred while submitting the form.</div>');
            }
        });
    });
});
