<?php

session_start();


include 'database_connection.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input values
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $authQuery = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($authQuery);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['username'] = $user['username'];
        $roleQuery = "SELECT role FROM users WHERE username = '$username'";
        $roleResult = $conn->query($roleQuery);
        $roleRow = $roleResult->fetch_assoc();

        
        $_SESSION['role'] = $roleRow['role'];

        
        header('Location: planner_dashboard.php');
        exit();
    } else {
        header('Location: login.html?error=Invalid username or password');
        exit();
    }
}

$conn->close();
?>

