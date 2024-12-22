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
        facultyName: "Faculty name must only contain<br> alphabetic characters (2-25)",
        position: "Position must contain alphabetic characters (2-25)",
        address: "Address must be between 5 and 50 characters",
        dob: "Age should be between  18 and 60",
        startDate: "Start date is required",
        department: "Please select the department",
        salary: "Salary must be a positive number between 3000 and 100000",
        phoneNumber: "Phone number must start with <br>98 or 97 and have 10 digits",
        status: "Please select the status"
    };

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
    

    // Function to clear the error message
    function clearError(input) {
        input.classList.remove("is-invalid");
        let errorElement = input.nextElementSibling;
        if (errorElement && errorElement.classList.contains("invalid-feedback")) {
            errorElement.remove();
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
    status.addEventListener('change', validateStatus);
    department.addEventListener('change', validateDepartment);

    function validateDepartment() {
        if (department.value === "") {
            showError(department, errorMessages.department);
        } else {
            clearError(department);
        }
    }

    function validateFacultyId() {
        const regex = /^TEA-\d{4}-\d{4}$/;
        if (!regex.test(facultyId.value)) {
            showError(facultyId, errorMessages.facultyId);
        } else {
            clearError(facultyId);
        }
    }

    function validateFacultyName() {
        const regex = /^[A-Za-z\s]+$/;
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
        let age = today.getFullYear() - dobDate.getFullYear();
        const monthDifference = today.getMonth() - dobDate.getMonth();
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
            age--;
        }
        if (age < 18 || age > 60) {
            showError(dob, errorMessages.dob);
        } else {
            clearError(dob);
        }
    }

    function validateStartDate() {
        if (!startDate.value) {
            showError(startDate, errorMessages.startDate);
        } else {
            const selectedDate = new Date(startDate.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0); 
            selectedDate.setHours(0, 0, 0, 0); 
            
            if (selectedDate > today) {
                showError(startDate, "Start date cannot be in the future.");
            } else {
                clearError(startDate);
            }
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

    function validateStatus() {
        if (status.value === "") {
            showError(status, errorMessages.status);
        } else {
            clearError(status);
        }
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        validateFacultyId();
        validateFacultyName();
        validatePosition();
        validateAddress();
        validateDob();
        validateStartDate();
        validateSalary();
        validatePhoneNumber();
        validateStatus();
        validateDepartment();

        const isValidForm = form.querySelectorAll('.is-invalid').length === 0;
        if (isValidForm) {
            alert("Form is valid, submitting data...");
        } else {
            alert("Please correct the errors in the form.");
        }
    });
});
