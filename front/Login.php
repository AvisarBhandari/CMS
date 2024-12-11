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
    // Capture form data
    if (isset($_POST['role'])) {
        $role = $_POST['role'];  // Get the selected role (admin, faculty, or student)
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];  // Get the ID entered by the user
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];  // Get the password entered by the user
    }

    if (isset($_POST['remember-me'])) {
        $remember_me = $_POST['remember-me'];  // Check if the "Remember me" checkbox is checked
    }

    // Store form data in session variables
    $_SESSION['role'] = $role;
    $_SESSION['id'] = $id;
    $_SESSION['password'] = $password;
    $_SESSION['remember_me'] = $remember_me;

    // Redirect to another page to display the data
    header("Location: display_data.php");
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

<!-- <script src="../js/login.js"></script> -->




<body class="body">

  <div class="container">

    <div class="sid-img">
      <img class="imag" src="https://picsum.photos/770/792"" alt="">
            </div>



<div class=" logo">
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
      <h4 class="subtitle">
        Please login to your account.</h4>


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
            <input type="checkbox" id="remember-me" name="remember-me" 
            <?php if ($remember_me) echo 'checked'; ?>
            />
            <label for="remember-me">Remember me</label>
          </div>
          <div id="forgot-pass">
            <a href="#">Forgot password?</a>
          </div>
        </div>
        <button type="submit" class="btn">Login</button>


        <p class="login-text">
          Don't have an account? <a class="signup" href="signup.html">Sign up</a>
        </p>
      </form>
    </div>

  </div>
</body>

</html>