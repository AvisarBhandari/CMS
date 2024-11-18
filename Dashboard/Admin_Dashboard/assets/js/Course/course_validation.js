document.addEventListener("DOMContentLoaded", function () {
    const courseCodeInput = document.getElementById('course_code');
    const courseNameInput = document.getElementById('course_name');
    const departmentDropdown = document.getElementById('department');
    const creditsInput = document.getElementById('credits');
    const statusRadios = document.getElementsByName('course_status');
    const courseTypeInput = document.getElementById('course_type');
    const courseFeeInput = document.getElementById('course_fee'); 
    const form = document.getElementById('courseForm');

    const courseCodePattern = /^CO-\d{5}$/; 
    const courseNamePattern = /^[A-Za-z\s]{2,50}$/; 
    const creditHoursPattern = /^(?:\d+|\d+\.\d{1,2})$/; // Fixed to match valid numbers

    // Validate Course Fee
    function validateCourseFee() {
        const value = courseFeeInput.value; 
        const courseFeePattern = /^\d+(\.\d{1,2})?$/; 

        if (!courseFeePattern.test(value)) {
            showError(courseFeeInput, "Course fee must be a number with up to two decimal places.");
        } else {
            const numericFee = parseFloat(value);
            if (numericFee < 100000 || numericFee > 1500000) {
                showError(courseFeeInput, "Course fee must be between 100,000 and 1,500,000.");
            } else {
                showSuccess(courseFeeInput);
            }
        }
    }

    // Validate Course Code
    function validateCourseCode() {
        const value = courseCodeInput.value;
        if (!courseCodePattern.test(value)) {
            showError(courseCodeInput, "Course code must be in the <br>format CO-XXXXX (e.g., CO-12345).");
        } else {
            showSuccess(courseCodeInput);
        }
    }

    // Validate Course Name
    function validateCourseName() {
        const value = courseNameInput.value;
        if (!courseNamePattern.test(value)) {
            showError(courseNameInput, "Course name must contain only alphabets<br> and be between 2 and 50 characters.");
        } else {
            showSuccess(courseNameInput);
        }
    }

    // Validate Credits
    function validateCredits() {
        const value = creditsInput.value;
        if (!creditHoursPattern.test(value) || value < 60 || value > 200) {
            showError(creditsInput, "Credit hours must be between 60 and 200.");
        } else {
            showSuccess(creditsInput);
        }
    }

    

    // Validate Department
    function validateDepartment() {
        if (departmentDropdown.value === "") {
            showError(departmentDropdown, "You must select a department.");
        } else {
            showSuccess(departmentDropdown);
        }
    }

    // Validate Course Type
    function validateCourseType() {
        if (courseTypeInput.value === "") {
            showError(courseTypeInput, "You must select a course type.");
        } else {
            showSuccess(courseTypeInput);
        }
    }

    // Validate Status
    function validateStatus() {
        let isValid = false;
        for (const radio of statusRadios) {
            if (radio.checked) {
                isValid = true;
                break;
            }
        }
        if (!isValid) {
            showError(document.querySelector('.btn-group'), "You must select a status.");
        } else {
            showSuccess(document.querySelector('.btn-group'));
        }
    }

    // Show Error
    function showError(input, message) {
        input.classList.add("is-invalid");
        let errorElement = input.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains("invalid-feedback")) {
            errorElement = document.createElement("div");
            errorElement.classList.add("invalid-feedback");
            input.parentNode.appendChild(errorElement);
        }
        errorElement.innerHTML = message;
    }

    // Show Success
    function showSuccess(element) {
        element.classList.remove("is-invalid");
        element.classList.add("is-valid");
        const errorElement = element.nextElementSibling;
        if (errorElement && errorElement.classList.contains("invalid-feedback")) {
            errorElement.remove();
        }
    }

    // Event Listeners
    courseCodeInput.addEventListener("input", validateCourseCode);
    courseNameInput.addEventListener("input", validateCourseName);
    creditsInput.addEventListener("input", validateCredits);
    courseTypeInput.addEventListener("change", validateCourseType);
    courseFeeInput.addEventListener("input", validateCourseFee);
    for (const radio of statusRadios) {
        radio.addEventListener("change", validateStatus);
    }

    // Form Submission
    form.addEventListener("submit", function (event) {
        validateCourseCode();
        validateCourseName();
        validateCredits();
        validateDepartment();
        validateStatus();
        validateCourseType();
        validateCourseFee();

        const isValidForm = form.querySelectorAll('.is-invalid').length === 0;
        if (!isValidForm) {
            event.preventDefault(); 
        }
    });
});
