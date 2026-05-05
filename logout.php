<?php
// Start the session
session_start();
include 'database_connection.php';
// Check if the user is logged in
if (isset($_SESSION['username'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        // Clear session variables
        session_unset();
        
        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header("Location: login.html");
        exit();
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}
header("Location: login.html");
    exit();
?>