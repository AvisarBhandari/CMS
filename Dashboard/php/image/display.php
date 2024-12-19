<?php
// Start the session to store the image
session_start();
include '../db_connect.php';


$id = $_SESSION['id']; // or $_POST['id']
$role = $_SESSION['role']; // or $_POST['role']

// SQL query to get the image based on id and role
$sql = "SELECT image FROM images WHERE id = '$id' AND role = '$role'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if a record was found
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the image data
    $row = mysqli_fetch_assoc($result);
    $imageData = $row['image'];

    // Convert the image data to base64 encoding
    $img = 'data:image/jpeg;base64,' . base64_encode($imageData);

    // Return the base64 image as a JSON response
    echo json_encode(['image' => $img]);

} 

else{
    echo json_encode(['image' => null, 'message' => 'No image uploaded yet.']);
    exit();
}
// Close the database connection
mysqli_close($conn);
?>
