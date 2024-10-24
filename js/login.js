document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const inputs = {
        Id: document.getElementById("id"),
        password: document.getElementById("password"),
        rememberMe: document.getElementById("remember-me"),
        college: document.getElementById("college"),
    };

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission
        clearErrors();
        let isValid = validateForm();

        if (isValid) {
            alert("Login successful!");
            form.reset(); // Optionally reset the form
        }
    });

    // Event listeners for real-time validation
    inputs.password.addEventListener("input", function () {
        clearErrors();
        if (!validatePassword(inputs.password.value)) {
            showError(inputs.password, "Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, and a special character.");
        }
    });

    inputs.Id.addEventListener("input", function () {
        clearErrors();
        if (!validateID(inputs.Id.value)) {
            showError(inputs.Id, "Please use the correct format for ID (e.g., STU-1234-2024, TEA-1234-2024, ADM-1234-2024).");
        }
    });

    inputs.college.addEventListener("input", function () {
        clearErrors();
        if (!validateCollegeName(inputs.college.value)) {
            showError(inputs.college, "College name must contain only letters and spaces and be between 1 and 80 characters long.");
        }
    });

    function validateForm() {
        let isValid = true;

        // Validate ID
        if (!validateID(inputs.Id.value)) {
            showError(inputs.Id, "Please use the correct format for ID (e.g., STU-1234-2024, TEA-1234-2024, ADM-1234-2024).");
            isValid = false;
        }

        // Validate password strength
        if (!validatePassword(inputs.password.value)) {
            showError(inputs.password, "Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, and a special character.");
            isValid = false;
        }

        // Validate college name
        if (!validateCollegeName(inputs.college.value)) {
            showError(inputs.college, "College name must contain only letters and spaces and be between 1 and 80 characters long.");
            isValid = false;
        }

        return isValid;
    }

    function validateRequired(value) {
        return value.trim() !== ""; // Check if the input is not empty
    }

    function validateID(idValue) {
        let idPattern;
        
        if (idValue.startsWith("STU-")) {
            idPattern = /^STU-\d{4}-\d{4}$/; // Pattern for student IDs
        } else if (idValue.startsWith("TEA-")) {
            idPattern = /^TEA-\d{4}-\d{4}$/; // Pattern for teacher IDs
        } else if (idValue.startsWith("ADM-")) {
            idPattern = /^ADM-\d{4}-\d{4}$/; // Pattern for admin IDs
        } else {
            return false; // Invalid prefix
        }

        return idPattern.test(idValue); // Check if ID matches the pattern
    }

    function validatePassword(password) {
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return passwordPattern.test(password); // Check if password meets the criteria
    }

    function validateCollegeName(collegeName) {
        const collegeNamePattern = /^[A-Za-z\s]{1,80}$/;
        return collegeNamePattern.test(collegeName); // Check if college name contains only letters and spaces
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
