<?php
// Assuming you have already started the session and connected to the database
session_start();

// Assuming user's data is fetched from the database and stored in $user
// Replace this with actual code to fetch user from the database
$user = [
   'username' => 'user.name',
   'password' => '$2y$10$WZf9ftEZZZnJ5ef1Lbg72e5dHnSzLfB5OaR.SizbL8yvwYh/8K4s2', // example hashed password
];

// Form submission handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Check if password is provided in the form
   if (isset($_POST['password'])) {
      $password = $_POST['password'];

      // Verify the password using password_verify()
      if (password_verify($password, $user['password'])) {
         // Password is correct, process the settings update
         $username = $_POST['username'];
         $phone_no = $_POST['phone_no'];
         $address = $_POST['address'];

         // Perform the update in the database (make sure to sanitize input)
         // Example: Update user settings
         // $query = "UPDATE users SET username='$username', phone_no='$phone_no', address='$address' WHERE id='$_SESSION['user_id']'";
         // mysqli_query($conn, $query);

         echo "Settings saved successfully!";
      } else {
         // Password is incorrect
         echo "Incorrect password. Please try again.";
      }
   } else {
      echo "Password is required!";
   }
}
?>
