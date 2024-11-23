document.addEventListener("DOMContentLoaded", function () {
    const monthInput = document.getElementById('month');
    const earningsInput = document.getElementById('earnings');
    const expendituresInput = document.getElementById('expenditures');
    const form = document.getElementById('recordForm');

    // Validate Month (Required)
    function validateMonth() {
        if (monthInput.value === "") {
            showError(monthInput, "Month is required.");
        } else {
            showSuccess(monthInput);
        }
    }

    // Validate Earnings (Should not be negative or exceed 1 crore)
    function validateEarnings() {
        const earningsValue = earningsInput.value;
        if (earningsValue === "" || earningsValue < 0) {
            showError(earningsInput, "Earnings cannot be negative.");
        } else if (earningsValue > 100000000) {
            showError(earningsInput, "Earnings cannot exceed 1 crore.");
        } else {
            showSuccess(earningsInput);
        }
    }

    // Validate Expenditures (Should not be negative or exceed 1 crore)
    function validateExpenditures() {
        const expendituresValue = expendituresInput.value;
        if (expendituresValue === "" || expendituresValue < 0) {
            showError(expendituresInput, "Expenditures cannot be negative.");
        } else if (expendituresValue > 100000000) {
            showError(expendituresInput, "Expenditures cannot exceed 1 crore.");
        } else {
            showSuccess(expendituresInput);
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

    // Event Listeners for real-time validation
    monthInput.addEventListener("change", validateMonth);
    earningsInput.addEventListener("input", validateEarnings);
    expendituresInput.addEventListener("input", validateExpenditures);

    // Form Submission
    form.addEventListener("submit", function (event) {
        validateMonth();
        validateEarnings();
        validateExpenditures();

        const isValidForm = form.querySelectorAll('.is-invalid').length === 0;
        if (!isValidForm) {
            event.preventDefault(); // Prevent form submission if invalid
        }
    });
});
