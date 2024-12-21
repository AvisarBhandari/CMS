<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    // Get the selected role (admin, faculty, or student)
    if (isset($_POST['role'])) {
        $role = $_POST['role'];  // Get the selected role (admin, faculty, or student)
        $role = $_POST['role'];
    }

    // Get the ID entered by the user
    if (isset($_POST['id'])) {
        $id = $_POST['id'];  // Get the ID entered by the user
        $id = $_POST['id'];
    }

    // Get the password entered by the user
    if (isset($_POST['password'])) {
        $password = $_POST['password'];  // Get the password entered by the user
    }
        $password = $_POST['password'];

    if (isset($_POST['remember-me'])) {
        $remember_me = $_POST['remember-me'];  // Check if the "Remember me" checkbox is checked
    }

    // Check if the "Remember me" checkbox is checked
    $remember_me = isset($_POST['remember-me']) ? $_POST['remember-me'] : '';
    // Store form data in session variables
    $_SESSION['role'] = $role;
    $_SESSION['id'] = $id;
    $_SESSION['password'] = $password;
    $_SESSION['remember_me'] = $remember_me;


    // Redirect to another page to display the data
    // Redirect to another page to display the data (authentication.php in this case)
    header("Location: authentication.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Academy Keeper</title>
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/styleguide.css">
</head>

<body class="body">
  <div class="container">

    <div class="sid-img">
      <img class="imag" src="../img/login.jpg" alt="" style="width:770px;height:792px;">
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
      <form class="form" id="login-form" method="post">
        <div class="select">
          <div class="option">
            <input checked value="admin" name="role" id="admin" type="radio" class="input" />
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
            <a href="forgot_password">Forgot password?</a>
          </div>
        </div>
        <button type="submit" class="btn">Login</button>

        <p class="login-text">
          First Time Login? <a class="signup" href="signup.php">Sign up</a>
        </p>
      </form>
    </div>

  </div>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>

      // Real-time validation
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

        return isValid;
      }

      function validateID(idValue) {
        let idPattern;

        if (idValue.startsWith("STU-")) {
          idPattern = /^STU-\d{4}-\d{4}$/;
        } else if (idValue.startsWith("TEA-")) {
          idPattern = /^TEA-\d{4}-\d{4}$/;
        } else if (idValue.startsWith("ADM-")) {
          idPattern = /^ADM-\d{4}-\d{4}$/;
        } else {
          return false;
        }

        return idPattern.test(idValue);
      }

  </script>

  <?php
  if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
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
