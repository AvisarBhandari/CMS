document.addEventListener("DOMContentLoaded", function () {
    const studentRollInput = document.getElementById('student_roll');
    const studentNameInput = document.getElementById('student_name');
    const parentNameInput = document.getElementById('parent_name');
    const phoneNoInput = document.getElementById('phone_no');
    const parentPhoneNoInput = document.getElementById('parent_phone_no');
    const departmentDropdown = document.getElementById('department');
    const courseDropdown = document.getElementById('course');
    const genderDropdown = document.getElementById('gender');
    const emailInput = document.getElementById('email');
    const dobInput = document.getElementById('dob');
    const semesterInput = document.getElementById('semester');
    const admissionDateInput = document.getElementById('admission_date');
    const form = document.querySelector('form');

    const rollNoPattern = /^STU-\d{4}-\d{4}$/;
    const namePattern = /^[A-Za-z]{3,25}\s[A-Za-z]{3,25}$/;
    const phonePattern = /^(98|97)\d{8}$/;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    // Function to validate Roll Number
    function validateRollNo() {
        const value = studentRollInput.value;
        if (!rollNoPattern.test(value)) {
            showError(studentRollInput, "Roll No must be in the format STU-####-####.");
        } else {
            showSuccess(studentRollInput);
        }
    }

    // Function to validate Name
    function validateName(input, fieldName) {
        const value = input.value;
        if (!namePattern.test(value)) {
            showError(input, `${fieldName} must contain a first name and last name, 
                both between 3 and 25 characters`);
        } else {
            showSuccess(input);
        }
    }

    // Function to validate Phone No
    function validatePhoneNo(input, fieldName) {
        const value = input.value;
        if (!phonePattern.test(value)) {
            showError(input, `${fieldName} must start with 98 or 97 and have 10 digits.`);
        } else {
            showSuccess(input);
        }
    }

    // Function to validate Department
    function validateDepartment() {
        if (departmentDropdown && departmentDropdown.value === "") {
            showError(departmentDropdown, "You must select a department.");
        } else {
            showSuccess(departmentDropdown);
        }
    }

    // Function to validate Course
    function validateCourse() {
        if (courseDropdown && courseDropdown.value === "") {
            showError(courseDropdown, "You must select a course.");
        } else {
            showSuccess(courseDropdown);
        }
    }

    // Function to validate Gender
    function validateGender() {
        if (genderDropdown && genderDropdown.value === "") {
            showError(genderDropdown, "You must select a gender.");
        } else {
            showSuccess(genderDropdown);
        }
    }

    // Function to validate Email
    function validateEmail() {
        const value = emailInput.value;
        if (!emailPattern.test(value)) {
            showError(emailInput, "Please enter a valid email address.");
        } else {
            showSuccess(emailInput);
        }
    }

    // Function to validate Date of Birth
    function validateDob() {
        const dob = new Date(dobInput.value);
        if (dobInput.value === "") {
            showError(dobInput, "Date of Birth cannot be empty.");
        } else {
            const age = new Date().getFullYear() - dob.getFullYear();
            if (age < 16) {
                showError(dobInput, "Student must be at least 16 years old.");
            } else {
                showSuccess(dobInput);
            }
        }
    }

    // Function to validate Semester
    function validateSemester() {
        const semester = parseInt(semesterInput.value, 10);
        if (semester < 1 || semester > 8 || isNaN(semester)) {
            showError(semesterInput, "Semester must be between 1 and 8.");
        } else {
            showSuccess(semesterInput);
        }
    }

    // Function to validate Admission Date
    function validateAdmissionDate() {
        const admissionDate = admissionDateInput.value;
        if (!admissionDate) {
            showError(admissionDateInput, "Admission Date cannot be empty.");
        } else {
            showSuccess(admissionDateInput);
        }
    }

    // Function to display error message
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

    // Function to display success state
    function showSuccess(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        const errorElement = input.nextElementSibling;
        if (errorElement && errorElement.classList.contains("invalid-feedback")) {
            errorElement.remove();
        }
    }

    // Event listeners for real-time validation
    studentRollInput.addEventListener("input", validateRollNo);
    studentNameInput.addEventListener("input", () => validateName(studentNameInput, "Student Name"));
    parentNameInput.addEventListener("input", () => validateName(parentNameInput, "Parent Name"));
    phoneNoInput.addEventListener("input", () => validatePhoneNo(phoneNoInput, "Phone No"));
    parentPhoneNoInput.addEventListener("input", () => validatePhoneNo(parentPhoneNoInput, "Parent Phone No"));
    emailInput.addEventListener("input", validateEmail);
    dobInput.addEventListener("change", validateDob);
    semesterInput.addEventListener("input", validateSemester);
    admissionDateInput.addEventListener("change", validateAdmissionDate);

    // Form submit event to prevent submission if there are invalid fields
    form.addEventListener("submit", function (event) {
        validateRollNo();
        validateName(studentNameInput, "Student Name");
        validateName(parentNameInput, "Parent Name");
        validatePhoneNo(phoneNoInput, "Phone No");
        validatePhoneNo(parentPhoneNoInput, "Parent Phone No");
        validateDepartment();  
        validateCourse();      
        validateGender();
        validateEmail();
        validateDob();
        validateSemester();
        validateAdmissionDate();

        const isValidForm = form.querySelectorAll('.is-invalid').length === 0;
        if (!isValidForm) {
            event.preventDefault();
        }
    });
});
