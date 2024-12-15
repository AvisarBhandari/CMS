<?php
session_start();
// MySQL database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academy_keeper"; 
// Make connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection and throw error if not available
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an image file was uploaded
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    print_r($_FILES);
    $image = $_FILES['image']['tmp_name'];
    $imgContent = file_get_contents($image);

    // Insert image data into database as BLOB
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];

    $sql = "SELECT COUNT(*) AS count FROM images WHERE id = ?";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id); // "i" for integer

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Check if count is greater than 0
if ($row['count'] > 0) {
        $sql = "UPDATE images SET image = ? WHERE id = ? AND role = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sss', $imgContent, $id, $role);
    $current_id = $statement->execute() 
    or
    $_SESSION['status']= "Error";
    $_SESSION['massage']= "Problem on Image Insert";
    header("Location: ../../Admin_Dashboard/profile.php");
    die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());


    if ($current_id) {
        $_SESSION['status']= "Success";
        $_SESSION['massage']= "Image uploaded successfully.";
        header("Location: ../../Admin_Dashboard/profile.php");
    } else {
        $_SESSION['status']= "Error";
        $_SESSION['massage']= "Image upload failed, please try again.";
        header("Location: ../../Admin_Dashboard/profile.php");
    }

} else {




    $sql = "INSERT INTO images (image, id, role) VALUES (?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sss', $imgContent, $id, $role);
    $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());


    if ($current_id) {
        $_SESSION['status']= "Success";
        $_SESSION['massage']= "Image uploaded successfully.";
        header("Location: ../../Admin_Dashboard/profile.php");

    } else {
        $_SESSION['status']= "Error";
        $_SESSION['massage']= "Image upload failed, please try again.";
        header("Location: ../../Admin_Dashboard/profile.php");
    }
} 

}
else {
    $_SESSION['status']= "Error";
    $_SESSION['massage']= "Please select an image file to upload.";
    header("Location: ../../Admin_Dashboard/profile.php");
}

// Close the database connection
$conn->close();
