
        document.getElementById("name").addEventListener("input", validateName);
        document.getElementById("id").addEventListener("input", validateId);
        document.getElementById("phone").addEventListener("input", validatePhone);
        document.getElementById("address").addEventListener("input", validateAddress);
        document.getElementById("password").addEventListener("input", validatePassword);
        document.getElementById("confirm-password").addEventListener("input", validateConfirmPassword);

        function validateName() {
            const nameInput = document.getElementById("name");
            const nameError = document.querySelector(".name_Error");
            const namePattern = /^[a-zA-Z]{3,}\s[a-zA-Z]{3,}$/;  // First and Last Name pattern

            if (!namePattern.test(nameInput.value)) {
                nameError.textContent = "Please enter a valid first and last name.";
            } else {
                nameError.textContent = "";
            }
        }

        function validateId() {
            const idInput = document.getElementById("id");
            const idError = document.querySelector(".id_Error");
            const idPattern = /^(ADM|STU|TEA)-\d{4}-\d{4}$/; 

            if (!idPattern.test(idInput.value)) {
                idError.textContent = "ID must be in the format: ADM-1234-5678.";
            } else {
                idError.textContent = "";
            }
        }

        function validatePhone() {
            const phoneInput = document.getElementById("phone");
            const phoneError = document.querySelector(".phone_Error");
            const phonePattern = /^(97|98)\d{8,13}$/; 

            if (!phonePattern.test(phoneInput.value)) {
                phoneError.textContent = "Phone number invalid.";
            } else {
                phoneError.textContent = "";
            }
        }

        function validateAddress() {
            const addressInput = document.getElementById("address");
            const addressError = document.querySelector(".address_Error");

            if (addressInput.value.trim() === "") {
                addressError.textContent = "Address cannot be empty.";
            } else {
                addressError.textContent = "";
            }
        }

        function validatePassword() {
            const passwordInput = document.getElementById("password");
            const passwordError = document.querySelector(".password_Error");

            if (passwordInput.value.length < 8) {
                passwordError.textContent = "Password must be at least 8 characters long.";
            } else {
                passwordError.textContent = "";
            }
        }

        function validateConfirmPassword() {
            const passwordInput = document.getElementById("password");
            const confirmPasswordInput = document.getElementById("confirm-password");
            const confirmPasswordError = document.querySelector(".cPassword_Error");

            if (confirmPasswordInput.value !== passwordInput.value) {
                confirmPasswordError.textContent = "Passwords do not match.";
            } else {
                confirmPasswordError.textContent = "";
            }
        }
