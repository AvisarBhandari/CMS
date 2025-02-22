<?php
session_start(); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="../css/signup.css" />
  <link rel="stylesheet" href="../css/globals.css" />
  <link rel="stylesheet" href="../css/styleguide.css" />
  <link rel="stylesheet" href="../css/loading.css" />

  <script src="../js/loading.js"></script>
</head>

<body>
  <div class="loading">
    <div class="loader">
      <div>
        <ul>
          <li>
            <svg fill="currentColor" viewBox="0 0 90 120">
              <path
                d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z">
              </path>
            </svg>
          </li>
          <li>
            <svg fill="currentColor" viewBox="0 0 90 120">
              <path
                d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z">
              </path>
            </svg>
          </li>
          <li>
            <svg fill="currentColor" viewBox="0 0 90 120">
              <path
                d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z">
              </path>
            </svg>
          </li>
          <li>
            <svg fill="currentColor" viewBox="0 0 90 120">
              <path
                d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z">
              </path>
            </svg>
          </li>
          <li>
            <svg fill="currentColor" viewBox="0 0 90 120">
              <path
                d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z">
              </path>
            </svg>
          </li>
          <li>
            <svg fill="currentColor" viewBox="0 0 90 120">
              <path
                d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z">
              </path>
            </svg>
          </li>
        </ul>
      </div>
      <span>Loading</span>
    </div>
  </div>
  <div class="container">
    <div class="image-section">
      <img src="../img/about.png" alt="Sign Up Image" />
    </div>
    <div class="form-section">
      <div class="logo">
        <a href="landing.html">
          <img src="../img/untitled-1-1.png" alt="Logo" class="logoimg" />
          <div class="text-a">Academy</div>
          <div class="text-k">Keeper</div>
        </a>
      </div>
      <h2 class="signup">Sign up</h2>
      <p class="intro-text">
        Let's get you all set up so you can access your account.
      </p>
<form id="myForm" action="new_acount.php" method="POST">

  <div class="input-wrapper">
    <input type="text" id="name" name="name" required placeholder=" " />
    <label for="name" class="label">Name</label>
    <p class="name_Error" style="color:red;"></p>
  </div>

  <div class="input-group">
    <div class="input-wrapper">
      <input type="text" id="id" name="id" required placeholder="                 Eg. STU-1234-2024" />
      <label for="id" class="label">ID</label>
      <small class="id_Error" style="color:red;"></small>
    </div>

    <div class="input-wrapper">
      <input type="tel" id="phone" name="phone" required placeholder=" " />
      <label for="phone" class="label">Phone Number</label>
      <p class="phone_Error"style="color:red;"></p>
    </div>
  </div>

  <div class="input-wrapper">
    <input type="email" id="address" name="address" placeholder="" />
    <label for="address" class="label">Email Address</label>
    <p class="address_Error"style="color:red;"></p>
  </div>

  <div class="input-group">
    <div class="input-wrapper">
      <input type="password" id="password" name="password" required placeholder=" " />
      <label for="password" class="label">Password</label>
      <p class="password_Error"style="color:red;"></p>
    </div>

    <div class="input-wrapper">
      <input type="password" id="confirm-password" name="confirm_password" required placeholder=" " />
      <label for="confirm-password" class="label">Confirm Password</label>
      <p class="cPassword_Error"style="color:red;"></p>
    </div>
  </div>

  <div class="checkbox-group">
    <input type="checkbox" name="terms" required />
    <label>I agree to all the <a href="tearms.html">Terms</a> and
      <a href="../front/Policies.html">Privacy Policies</a></label>
  </div>

  <button type="submit" class="btn">Create account</button>
</form>


      
      <p class="login-text">
        Already have an account? <a href="../front/Login.php">Login</a>
      </p>
    </div>
  </div>


<script>
  document.getElementById("name").addEventListener("input", validateName);
document.getElementById("id").addEventListener("input", validateId);
document.getElementById("phone").addEventListener("input", validatePhone);
document.getElementById("address").addEventListener("input", validateAddress);
document.getElementById("password").addEventListener("input", validatePassword);
document.getElementById("confirm-password").addEventListener("input", validateConfirmPassword);

// Validate form before submission
document.getElementById("myForm").addEventListener("submit", function(event) {
    let formIsValid = true;  // Flag to check if form is valid

    // Validate each field
    formIsValid &= validateName();
    formIsValid &= validateId();
    formIsValid &= validatePhone();
    formIsValid &= validateAddress();
    formIsValid &= validatePassword();
    formIsValid &= validateConfirmPassword();

    // If any validation fails, prevent form submission
    if (!formIsValid) {
        event.preventDefault();  // Prevent form submission
    }
});

// Validate Name
function validateName() {
    const nameInput = document.getElementById("name");
    const nameError = document.querySelector(".name_Error");
    const namePattern = /^[a-zA-Z]+\s[a-zA-Z]+$/;  // First and Last Name pattern

    if (!namePattern.test(nameInput.value)) {
        nameError.textContent = "Please enter a valid first and last name.";
        return false;
    } else {
        nameError.textContent = "";
        return true;
    }
}

// Validate ID
function validateId() {
    const idInput = document.getElementById("id");
    const idError = document.querySelector(".id_Error");
    const idPattern = /^(ADM|STU|TEA)-\d{4}-\d{4}$/; // ID format validation

    if (!idPattern.test(idInput.value)) {
        idError.textContent = "ID must be in the format: ADM-1234-5678.";
        return false;
    } else {
        idError.textContent = "";
        return true;
    }
}

// Validate Phone Number
function validatePhone() {
    const phoneInput = document.getElementById("phone");
    const phoneError = document.querySelector(".phone_Error");
    const phonePattern = /^(97|98)\d{8,13}$/; 

    if (!phonePattern.test(phoneInput.value)) {
        phoneError.textContent = "Phone number invalid.";
        return false;
    } else {
        phoneError.textContent = "";
        return true;
    }
}

// Validate Address
function validateAddress() {
    const email = document.getElementById("address");
    const emailError = document.querySelector(".address_Error");

    const emailValue = email.value.trim();
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailValue) {
        emailError.textContent = "Email is required.";
    } else if (!emailPattern.test(emailValue)) {
        emailError.textContent = "Please enter a valid email address.";
    } else {
        emailError.textContent = ""; // Clear error message if valid
    }
}

// Validate Password
function validatePassword() {
    const passwordInput = document.getElementById("password");
    const passwordError = document.querySelector(".password_Error");

    if (passwordInput.value.length < 8) {
        passwordError.textContent = "Password must be at least 8 characters long.";
        return false;
    } else {
        passwordError.textContent = "";
        return true;
    }
}

// Validate Confirm Password
function validateConfirmPassword() {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm-password");
    const confirmPasswordError = document.querySelector(".cPassword_Error");

    if (confirmPasswordInput.value !== passwordInput.value) {
        confirmPasswordError.textContent = "Passwords do not match.";
        return false;
    } else {
        confirmPasswordError.textContent = "";
        return true;
    }
}

</script>

  <script src="../js/sweetalert.js"></script>

<?php

if (isset($_SESSION['status']) && isset($_SESSION['massage'])) {
  $_SESSION['error']
?>
<script>
console.log("<?php
echo $_SESSION['error'];
?>");
swal({
    title: "<?php echo $_SESSION['massage']; ?>",
    icon: "<?php echo $_SESSION['status']; ?>"
});
</script>



<?php

// After showing the message, unset the session variables.
unset($_SESSION['status']);
unset($_SESSION['massage']);
unset($_SESSION['error']);
}
?>
</body>

</html>