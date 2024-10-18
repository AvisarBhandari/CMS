const form = document.querySelector('form');
const inputs = {
    studentId: document.getElementById('student-id'),
    password: document.getElementById('password'),
    rememberMe: document.getElementById('remember-me')
};

// Function to show error messages
function showError(input, message) {
    const error = document.createElement('span');
    error.className = 'error-message';
    error.textContent = message;
    input.parentElement.appendChild(error);
}

// Function to clear all errors
function clearErrors() {
    document.querySelectorAll('.error-message').forEach(error => error.remove());
}

// Function to validate required fields
function validateRequired(value) {
    return value.trim() !== '';
}

// Function to validate password strength
function validatePassword(password) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordPattern.test(password);
}

// Validate the form on submission
form.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission
    clearErrors(); // Clear previous errors
    let isValid = true;

    // Validate student ID
    if (!validateRequired(inputs.studentId.value)) {
        showError(inputs.studentId, "Student ID is required.");
        isValid = false;
    }

    // Validate password
    if (!validatePassword(inputs.password.value)) {
        showError(inputs.password, "Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, and a special character.");
        isValid = false;
    }

    // If the form is valid, you can proceed with the submission or further processing
    if (isValid) {
        alert("Login successful!");
        form.reset(); // Optionally reset the form
    }
});

//  Real-time validation for password input
inputs.password.addEventListener('input', function () {
    clearErrors();
    if (validatePassword(inputs.password.value)) {
    } else if (inputs.password.value.length > 0) {
        showError(inputs.password, "Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, and a special character.");
    }
});

// Real-time validation for student ID input
inputs.studentId.addEventListener('input', function () {
    clearErrors();
    if (!validateRequired(inputs.studentId.value) && inputs.studentId.value.length > 0) {
        showError(inputs.studentId, "Student ID is required.");
    }
});
