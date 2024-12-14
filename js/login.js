document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const inputId = document.getElementById("id");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission
        clearErrors();
        
        if (!validateID(inputId.value)) {
            showError(inputId, "Please use the correct format for ID (e.g., STU-1234-2024, TEA-1234-2024, ADM-1234-2024).");
        } else {
            // If validation passes, allow form submission or handle accordingly
            alert("ID is valid!");
            // Uncomment the following line to submit the form after validation
            // form.submit();
        }
    });

    // Real-time validation for ID
    inputId.addEventListener("input", function () {
        clearErrors();
        if (!validateID(inputId.value)) {
            showError(inputId, "Please use the correct format for ID (e.g., STU-1234-2024, TEA-1234-2024, ADM-1234-2024).");
        }
    });

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
