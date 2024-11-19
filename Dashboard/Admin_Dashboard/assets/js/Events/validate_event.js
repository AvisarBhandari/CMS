document.addEventListener("DOMContentLoaded", function () {
    const eventDateInput = document.getElementById('event_date');
    const eventNameInput = document.getElementById('event_name');
    const eventTimeInput = document.getElementById('event_time');
    const eventForm = document.getElementById('eventForm');


    function validateEventDate() {
        const value = eventDateInput.value;
        const currentDate = new Date();
        const selectedDate = new Date(value);
        
      
        const maxDate = new Date();
        maxDate.setMonth(currentDate.getMonth() + 1);
        
        if (selectedDate < currentDate || selectedDate > maxDate) {
            showError(eventDateInput, "Event date must be within one month from today.");
        } else {
            showSuccess(eventDateInput);
        }
    }

  
    function validateEventName() {
        const value = eventNameInput.value;
        if (value.length < 5) {
            showError(eventNameInput, "Event name must be at least 5 characters long.");
        } else if (value.length > 100) {
            showError(eventNameInput, "Event name must not exceed 100 characters.");
        } else {
            showSuccess(eventNameInput);
        }
    }

  
    function validateEventTime() {
        const value = eventTimeInput.value;
        const currentDate = new Date();
        const currentTime = currentDate.getHours() * 60 + currentDate.getMinutes();
        
        const selectedTime = value.split(":");
        const eventTime = parseInt(selectedTime[0]) * 60 + parseInt(selectedTime[1]);
        
        if (eventTime <= currentTime) {
            showError(eventTimeInput, "Event time must be in the future.");
        } else {
            showSuccess(eventTimeInput);
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

    eventDateInput.addEventListener("input", validateEventDate);
    eventNameInput.addEventListener("input", validateEventName);
    eventTimeInput.addEventListener("input", validateEventTime);

   
    eventForm.addEventListener("submit", function (event) {
        validateEventDate();
        validateEventName();
        validateEventTime();

        const isValidForm = eventForm.querySelectorAll('.is-invalid').length === 0;
        if (!isValidForm) {
            event.preventDefault(); 
        }
    });
});
