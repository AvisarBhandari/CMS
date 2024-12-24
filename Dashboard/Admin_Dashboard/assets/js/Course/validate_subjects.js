document.addEventListener("DOMContentLoaded", function () {
    const subjectCodeInput = document.getElementById("subjectCode");
    const subjectNameInput = document.getElementById("subjectName");
    const subjectCreditsInput = document.getElementById("subjectCredits");
    const subjectSemesterInput = document.getElementById("subjectSemester");
    const syllabusStatusDropdown = document.getElementById("syllabusStatus");
    const subjectForm = document.getElementById("subjectForm");

    const subjectCodePattern = /^SUB-\d{4}$/;
    const subjectNamePattern = /^[A-Za-z\s]{4,50}$/;

    // Function to validate Subject Code
    function validateSubjectCode() {
        const value = subjectCodeInput.value;
        if (!subjectCodePattern.test(value)) {
            showError(subjectCodeInput, "Subject Code must be in the format SUB-####.");
        } else {
            showSuccess(subjectCodeInput);
        }
    }

    // Function to validate Subject Name
    function validateSubjectName() {
        const value = subjectNameInput.value.trim();
        if (!subjectNamePattern.test(value)) {
            showError(subjectNameInput, "Subject Name must be between 4 and 50 alphabets.");
        } else {
            showSuccess(subjectNameInput);
        }
    }

    // Function to validate Subject Credits
    function validateSubjectCredits() {
        const value = parseFloat(subjectCreditsInput.value);
        if (isNaN(value) || value < 0 || value > 10) {
            showError(subjectCreditsInput, "Credits must be between 0 and 10.");
        } else {
            showSuccess(subjectCreditsInput);
        }
    }

    // Function to validate Semester
    function validateSubjectSemester() {
        const value = parseInt(subjectSemesterInput.value, 10);
        if (isNaN(value) || value < 1 || value > 8) {
            showError(subjectSemesterInput, "Semester must be between 1 and 8.");
        } else {
            showSuccess(subjectSemesterInput);
        }
    }

    // Function to validate Syllabus Status
    function validateSyllabusStatus() {
        if (syllabusStatusDropdown.value === "") {
            showError(syllabusStatusDropdown, "You must select a syllabus status.");
        } else {
            showSuccess(syllabusStatusDropdown);
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
    subjectCodeInput.addEventListener("input", validateSubjectCode);
    subjectNameInput.addEventListener("input", validateSubjectName);
    subjectCreditsInput.addEventListener("input", validateSubjectCredits);
    subjectSemesterInput.addEventListener("input", validateSubjectSemester);
    syllabusStatusDropdown.addEventListener("change", validateSyllabusStatus);

    // Form submit event to prevent submission if there are invalid fields
    subjectForm.addEventListener("submit", function (event) {
        validateSubjectCode();
        validateSubjectName();
        validateSubjectCredits();
        validateSubjectSemester();
        validateSyllabusStatus();

        const isValidForm = subjectForm.querySelectorAll(".is-invalid").length === 0;
        if (!isValidForm) {
            event.preventDefault();
        }
    });
});
