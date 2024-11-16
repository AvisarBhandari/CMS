document.addEventListener("DOMContentLoaded", function () {
    const courseCodeInput = document.getElementById('course_code');
    const courseNameInput = document.getElementById('course_name');
    const departmentDropdown = document.getElementById('department');
    const creditsInput = document.getElementById('credits');
    const semesterInput = document.getElementById('sem');
    const statusRadios = document.getElementsByName('course_status');
    const form = document.getElementById('courseForm');

  
    const courseCodePattern = /^CO-\d{5}$/; 
    const courseNamePattern = /^[A-Za-z\s]{2,50}$/; 
    const creditHoursPattern = /^(?:[1-8](?:\.\d{1,2})?)$/;
    const semesterPattern = /^[1-8]$/; // 

   
    function validateCourseCode() {
        const value = courseCodeInput.value;
        if (!courseCodePattern.test(value)) {
            showError(courseCodeInput, "Course code must be in the <br>format CO-XXXXX (e.g., CO-12345).");
        } else {
            showSuccess(courseCodeInput);
        }
    }

    function validateCourseName() {
        const value = courseNameInput.value;
        if (!courseNamePattern.test(value)) {
            showError(courseNameInput, "Course name must contain only alphabets<br> and be between 2 and 50 characters.");
        } else {
            showSuccess(courseNameInput);
        }
    }

    function validateCredits() {
        const value = creditsInput.value;
        if (!creditHoursPattern.test(value)) {
            showError(creditsInput, "Credit hours must be between 1 and 8.");
        } else {
            showSuccess(creditsInput);
        }
    }

    function validateSemester() {
        const value = semesterInput.value;
        if (!semesterPattern.test(value)) {
            showError(semesterInput, "Semester must be an integer between 1 and 8.");
        } else {
            showSuccess(semesterInput);
        }
    }

    function validateDepartment() {
        if (departmentDropdown.value === "") {
            showError(departmentDropdown, "You must select a department.");
        } else {
            showSuccess(departmentDropdown);
        }
    }

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
    

    function showSuccess(element) {
        element.classList.remove("is-invalid");
        element.classList.add("is-valid");
        const errorElement = element.nextElementSibling;
        if (errorElement && errorElement.classList.contains("invalid-feedback")) {
            errorElement.remove();
        }
    }

  
    courseCodeInput.addEventListener("input", validateCourseCode);
    courseNameInput.addEventListener("input", validateCourseName);
    creditsInput.addEventListener("input", validateCredits);
    semesterInput.addEventListener("input", validateSemester);
    // departmentDropdown.addEventListener("change", validateDepartment);
    for (const radio of statusRadios) {
        radio.addEventListener("change", validateStatus);
    }

   
    form.addEventListener("submit", function (event) {
        validateCourseCode();
        validateCourseName();
        validateCredits();
        validateSemester();
        validateDepartment();
        validateStatus();

        const isValidForm = form.querySelectorAll('.is-invalid').length === 0;
        if (!isValidForm) {
            event.preventDefault(); 
        }
    });
});
