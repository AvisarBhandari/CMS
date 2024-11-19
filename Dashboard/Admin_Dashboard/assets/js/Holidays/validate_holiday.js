document.addEventListener("DOMContentLoaded", function () {
    const holidayDateInput = document.getElementById('holiday_date');
    const holidayReasonInput = document.getElementById('reason');
    const holidayForm = document.getElementById('holidayForm');

    // Validate Holiday Date
    function validateHolidayDate() {
        const value = holidayDateInput.value;
        const currentDate = new Date();
        const selectedDate = new Date(value);
        
        // Allow only holidays within one month from today
        const maxDate = new Date();
        maxDate.setMonth(currentDate.getMonth() + 1);
        
        if (selectedDate < currentDate || selectedDate > maxDate) {
            showError(holidayDateInput, "Holiday date must be within one month from today.");
        } else {
            showSuccess(holidayDateInput);
        }
    }

    // Validate Holiday Reason
    function validateHolidayReason() {
        const value = holidayReasonInput.value;
        if (value.length < 5) {
            showError(holidayReasonInput, "Holiday reason must be at least 5 characters long.");
        } else if (value.length > 100) {
            showError(holidayReasonInput, "Holiday reason must not exceed 100 characters.");
        } else {
            showSuccess(holidayReasonInput);
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
    holidayDateInput.addEventListener("input", validateHolidayDate);
    holidayReasonInput.addEventListener("input", validateHolidayReason);

    // Form Submission
    holidayForm.addEventListener("submit", function (event) {
        validateHolidayDate();
        validateHolidayReason();

        const isValidForm = holidayForm.querySelectorAll('.is-invalid').length === 0;
        if (!isValidForm) {
            event.preventDefault(); 
        }
    });
});
