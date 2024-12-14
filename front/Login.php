<?php
// Start the session at the beginning of the script
session_start();

// Initialize variables to store form data
$role = '';
$id = '';
$password = '';
$remember_me = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected role (admin, faculty, or student)
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
    }

    // Get the ID entered by the user
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    // Get the password entered by the user
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    // Check if the "Remember me" checkbox is checked
    $remember_me = isset($_POST['remember-me']) ? $_POST['remember-me'] : '';

    // Store form data in session variables
    $_SESSION['role'] = $role;
    $_SESSION['id'] = $id;
    $_SESSION['password'] = $password;
    $_SESSION['remember_me'] = $remember_me;

    // Redirect to another page to display the data (authentication.php in this case)
    header("Location: authentication.php");
    exit();
}
?>

<html>

<head>
  <title>Academy Keeper</title>
</head>
<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/globals.css">
<link rel="stylesheet" href="../css/styleguide.css">

<!-- <script src="/js/login.js"></script> -->

<body class="body">

  <div class="container">

    <div class="sid-img">
      <img class="imag" src="https://picsum.photos/770/792" alt="">
    </div>

    <div class="logo">
      <div class="overlap-group">
        <a href="landing.html">
          <img class="untitled" src="../img/untitled-1-1.png" />
          <div class="text-wrapper">Academy</div>
          <div class="text-wrapper-2">Keeper</div>
        </a>
      </div>
    </div>

    <div class="login">
      <h2 class="title">Login</h2>
      <h4 class="subtitle">Please login to your account.</h4>
    </div>

    <div class="login-form">
      <form class="form" action="" method="post">
        <div class="select">
          <div class="option">
            <input checked="" value="admin" name="role" id="admin" type="radio" class="input" />
            <label for="admin" class="label">Administrator</label>
            <input value="faculty" name="role" id="faculty" type="radio" class="input" />
            <label for="faculty" class="label">Faculty</label>
            <input value="student" name="role" id="student" type="radio" class="input" />
            <label for="student" class="label">Student</label>
          </div>
        </div>

        <div class="input-group">
          <div class="input-wrapper">
            <input type="text" id="id" name="id" required placeholder=" " />
            <label for="id" class="label">ID</label>
          </div>

          <div class="input-wrapper">
            <input type="password" id="password" name="password" required placeholder=" " />
            <label for="password" class="label-password">Password</label>
          </div>
        </div>

        <div class="checkbox-group">
          <div class="remember-me">
            <input type="checkbox" id="remember-me" name="remember-me" />
            <label for="remember-me">Remember me</label>
          </div>
          <div id="forgot-pass">
            <a href="#">Forgot password?</a>
          </div>
        </div>
        <button type="submit" class="btn">Login</button>

        <p class="login-text">
          First Time Login? <a class="signup" href="signup.html">Sign up</a>
        </p>
      </form>
    </div>

  </div>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const form = document.querySelector("form");
      const inputs = {
        Id: document.getElementById("id"),
        rememberMe: document.getElementById("remember-me"),
      };

      form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission
        clearErrors();
        let isValid = validateForm();

        // if (isValid) {
        //     alert("Login successful!");
        //     // form.reset();
        // }
      });

      // Event listeners for real-time validation
      inputs.Id.addEventListener("input", function () {
        clearErrors();
        if (!validateID(inputs.Id.value)) {
          showError(inputs.Id, "Please use the correct format for ID (e.g., STU-1234-2024, TEA-1234-2024, ADM-1234-2024).");
        }
      });

      function validateForm() {
        let isValid = true;

        // Validate ID
        if (!validateID(inputs.Id.value)) {
          showError(inputs.Id, "Please use the correct format for ID (e.g., STU-1234-2024, TEA-1234-2024, ADM-1234-2024).");
          isValid = false;
        }

        return isValid;  // Return the validation result
      }

      function validateRequired(value) {
        return value.trim() !== ""; // Check if the input is not empty
      }

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
  </script>

  <?php
  if(isset($_SESSION['status']) && isset($_SESSION['message'])) {
  ?>
  <script>
  swal({
    title: "<?php echo $_SESSION['message']; ?>",
    icon: "<?php echo $_SESSION['status']; ?>",
  });
  </script>
  <?php
  unset($_SESSION['status']);
  unset($_SESSION['message']);
  }
  ?>

</body>
</html>
