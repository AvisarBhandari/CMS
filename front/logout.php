<?php
include('db_connect.php');
session_start();
            $id = $_SESSION['id'];
            $cookie_name = 'login';
            
                setcookie("cookieName", "", time() - 3600, "/");

                // Delete the old cookie if it exists
                $delete_cookie_query = "DELETE FROM cookie WHERE c_name = 'login' AND id = ?";
                $delete_cookie_stmt = $conn->prepare($delete_cookie_query);
                $delete_cookie_stmt->bind_param("s", $id);
                $delete_cookie_stmt->execute();
                header('Location: Login.php');

?>