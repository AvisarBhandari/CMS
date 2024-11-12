document.addEventListener('DOMContentLoaded', function () {
    // Get references to form and input elements
    const form = document.getElementById('facultyForm');
    const facultyId = document.getElementById('faculty_id');
    const facultyName = document.getElementById('faculty_name');
    const position = document.getElementById('position');
    const address = document.getElementById('address');
    const dob = document.getElementById('dob');
    const startDate = document.getElementById('start_date');
    const salary = document.getElementById('salary');
    const phoneNumber = document.getElementById('phone_number');
    const department = document.getElementById('department');
    const status = document.getElementById('status');

    // Error messages
    const errorMessages = {
        facultyId: "Faculty ID must be in the format TEA-1234-5678",
        facultyName: "Faculty name must only contain alphabetic(2-25)",
        position: "Position must be Alphabets(2-25)",
        address: "Address must be between 5 and 50 characters",
        dob: "Age should be greater than 18",
        startDate: "Start date is required",
        salary: "Salary must be a positive number between 3000 and 100000",
        phoneNumber: "Phone number must start with 98 or 97 and have 10 digits",
        department: "Please select a department",
        status: "Please select the status"
    };

    // Function to create an error message element
    function createErrorMessage(message) {
        const errorMessage = document.createElement('div');
        errorMessage.classList.add('error-message');
        errorMessage.style.color = 'red';
        errorMessage.style.fontSize = '12.5px';
        errorMessage.style.padding = '5px';
        errorMessage.style.marginBottom = '8px';
        errorMessage.style.fontWeight = 'bold';
        errorMessage.style.textAlign = 'center';
        errorMessage.style.position='relative';
        errorMessage.style.left='-50px';
        errorMessage.textContent = message;
        return errorMessage;
    }

    // Function to display error message under input fields
    function showError(input, message) {
        // Check if there's already an error message, if so, remove it
        const existingError = input.nextElementSibling;
        if (existingError && existingError.classList.contains('error-message')) {
            existingError.remove();
        }

        // Create and show error message
        const errorMessage = createErrorMessage(message);
        input.parentNode.appendChild(errorMessage);
    }

    // Function to remove the error message
    function clearError(input) {
        const existingError = input.nextElementSibling;
        if (existingError && existingError.classList.contains('error-message')) {
            existingError.remove();
        }
    }

    // Real-time validation functions
    facultyId.addEventListener('input', validateFacultyId);
    facultyName.addEventListener('input', validateFacultyName);
    position.addEventListener('input', validatePosition);
    address.addEventListener('input', validateAddress);
    dob.addEventListener('change', validateDob);
    startDate.addEventListener('change', validateStartDate);
    salary.addEventListener('input', validateSalary);
    phoneNumber.addEventListener('input', validatePhoneNumber);
    department.addEventListener('change', validateDepartment);
    status.addEventListener('change', validateStatus);

    function validateFacultyId() {
        const regex = /^TEA-\d{4}-\d{4}$/;
        if (!regex.test(facultyId.value)) {
            showError(facultyId, errorMessages.facultyId);
        } else {
            clearError(facultyId);
        }
    }

    function validateFacultyName() {
        const regex = /^[A-Za-z\s]+$/;  // Only allows alphabetic characters and spaces
        if (facultyName.value.length < 2 || facultyName.value.length > 25 || !regex.test(facultyName.value)) {
            showError(facultyName, errorMessages.facultyName);
        } else {
            clearError(facultyName);
        }
    }

    function validatePosition() {
        const regex = /^[A-Za-z\s]+$/;
        if (position.value.length < 2 || position.value.length > 25 || !regex.test(position.value)) {
            showError(position, errorMessages.position);
        } else {
            clearError(position);
        }
    }
    

    function validateAddress() {
        if (address.value.length < 5 || address.value.length > 50) {
            showError(address, errorMessages.address);
        } else {
            clearError(address);
        }
    }

    function validateDob() {
        const dobValue = dob.value;
        if (!dobValue) {
            showError(dob, errorMessages.dob);
            return;
        }
        const dobDate = new Date(dobValue);
        const today = new Date();
        const age = today.getFullYear() - dobDate.getFullYear();
        const monthDifference = today.getMonth() - dobDate.getMonth();
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
            age--;
        }
        if (age < 18) {
            showError(dob, errorMessages.dob);
        } else {
            clearError(dob);
        }
    }
    

    function validateStartDate() {
        if (!startDate.value) {
            showError(startDate, errorMessages.startDate);
        } else {
            clearError(startDate);
        }
    }

    function validateSalary() {
        if (salary.value < 3000 || salary.value > 100000 || isNaN(salary.value) || salary.value <= 0) {
            showError(salary, errorMessages.salary);
        } else {
            clearError(salary);
        }
    }

    function validatePhoneNumber() {
        const regex = /^(98|97)\d{8}$/;
        if (!regex.test(phoneNumber.value)) {
            showError(phoneNumber, errorMessages.phoneNumber);
        } else {
            clearError(phoneNumber);
        }
    }

    // Real-time validation for department
    function validateDepartment() {
        if (department.value === "") {
            showError(department, errorMessages.department);
        } else {
            clearError(department);
        }
    }

    // Real-time validation for status
    function validateStatus() {
        if (status.value === "") {
            showError(status, errorMessages.status);
        } else {
            clearError(status);
        }
    }

    // Submit handler (can be used to check if the form is valid)
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission to handle validation

        // Check if the form is valid
        if (form.checkValidity()) {
            // Proceed with AJAX submission or any further logic
            alert("Form is valid, submitting data...");
        } else {
            alert("Please correct the errors in the form.");
        }
    });
});
