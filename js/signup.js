document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const inputs = {
        firstName: document.getElementById("first-name"),
        lastName: document.getElementById("last-name"),
        studentId: document.getElementById("student-id"),
        phone: document.getElementById("phone"),
        password: document.getElementById("password"),
        confirmPassword: document.getElementById("confirm-password"),
        terms: document.querySelector("input[name='terms']"),
        college: document.getElementById("college"),
        role: document.querySelector('input[name="role"]:checked') // Added for role
    };

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission
        clearErrors();
        let isValid = validateForm();

        if (isValid) {
            form.submit(); // Submit the form if valid
        }
    });

    // Event listeners for real-time validation
    inputs.firstName.addEventListener("input", function () {
        clearErrors();
        if (!validateName(inputs.firstName.value)) {
            showError(inputs.firstName, "First Name must contain only letters and be between 1 and 50 characters long");
        }
    });

    inputs.lastName.addEventListener("input", function () {
        clearErrors();
        if (!validateName(inputs.lastName.value)) {
            showError(inputs.lastName, "Last Name must contain only letters and be between 1 and 50 characters long");
        }
    });

    inputs.phone.addEventListener("input", function () {
        clearErrors();
        if (!validatePhoneNumber(inputs.phone.value)) {
            showError(inputs.phone, "Phone Number must start with 97 or 98 and be between 10 to 15 digits");
        }
    });

    inputs.password.addEventListener("input", function () {
        clearErrors();
        if (!validatePassword(inputs.password.value)) {
            showError(inputs.password, "Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, and a special character.");
        }
    });

    inputs.confirmPassword.addEventListener("input", function () {
        clearErrors();
        if (inputs.password.value !== inputs.confirmPassword.value) {
            showError(inputs.confirmPassword, "Passwords do not match");
        }
    });

    // Validate the college input field in real-time
    inputs.college.addEventListener("input", function () {
        clearErrors();
        if (!validateCollegeName(inputs.college.value)) {
            showError(inputs.college, "College name must contain only letters and spaces and be between 1 and 80 characters long.");
        }
    });

    // Validate the role selection in real-time
    document.querySelectorAll('input[name="role"]').forEach((radio) => {
        radio.addEventListener("change", function () {
            clearErrors();
            if (!validateRoleSelected()) {
                showError(radio, "You must select a role");
            }
        });
    });

    function validateForm() {
        let isValid = true;

        // Validate first name
        if (!validateName(inputs.firstName.value)) {
            showError(inputs.firstName, "First Name must contain only letters and be between 1 and 50 characters long");
            isValid = false;
        }

        // Validate last name
        if (!validateName(inputs.lastName.value)) {
            showError(inputs.lastName, "Last Name must contain only letters and be between 1 and 50 characters long");
            isValid = false;
        }

        // Validate student ID, phone number, and other fields
        for (const key in inputs) {
            if (key !== 'terms' && key !== 'role' && key !== 'college' && !validateRequired(inputs[key].value)) {
                showError(inputs[key], `${key.replace(/([A-Z])/g, ' $1')} is required`);
                isValid = false;
            }
        }

        // Validate phone number format
        if (!validatePhoneNumber(inputs.phone.value)) {
            showError(inputs.phone, "Phone Number must start with 97 or 98 and be between 10 to 15 digits");
            isValid = false;
        }

        // Validate password strength
        if (!validatePassword(inputs.password.value)) {
            showError(inputs.password, "Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, and a special character.");
            isValid = false;
        }

        // Validate password match
        if (inputs.password.value !== inputs.confirmPassword.value) {
            showError(inputs.confirmPassword, "Passwords do not match");
            isValid = false;
        }

        // Validate terms checkbox
        if (!inputs.terms.checked) {
            alert("You must agree to the terms and conditions");
            isValid = false;
        }

        // Validate college input
        if (!validateCollegeName(inputs.college.value)) {
            showError(inputs.college, "College name must contain only letters and be between 1 and 80 characters long.");
            isValid = false;
        }

        // Validate role selection
        if (!validateRoleSelected()) {
            showError(inputs.role, "You must select a role");
            isValid = false;
        }

        return isValid;
    }

    function validateName(name) {
        const nameRegex = /^[A-Za-z]+$/; // Allow only alphabetic characters
        return name.length >= 1 && name.length <= 50 && nameRegex.test(name); // Check length and regex
    }

    function validateRequired(value) {
        return value.trim() !== ""; // Check if the input is not empty
    }

    function validatePhoneNumber(value) {
        return /^(97|98)\d{8,13}$/.test(value); // Check phone number format
    }

    function validatePassword(password) {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;
        return passwordRegex.test(password); // Return true if the password matches the regex
    }

    function validateCollegeName(collegeName) {
        const nameRegex = /^[A-Za-z\s]+$/; // Allow only alphabetic characters and spaces
        return collegeName.length >= 1 && collegeName.length <= 80 && nameRegex.test(collegeName); // Check length and regex
    }

    function validateRoleSelected() {
        return document.querySelector('input[name="role"]:checked') !== null; // Check if a radio button is selected
    }

    function showError(input, message) {
        const errorSpan = document.createElement("span");
        errorSpan.className = "error-message"; // Use class for styling
        errorSpan.textContent = message;
        errorSpan.style.color = "red";
        input.parentElement.appendChild(errorSpan); // Display error message
    }

    function clearErrors() {
        document.querySelectorAll(".error-message").forEach(error => error.remove()); // Clear all error messages
    }
});
