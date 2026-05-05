<?php
session_start();


include 'database_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input
    $planName = htmlspecialchars(trim($_POST['planName']));

    
    if ($_SESSION['role'] === 'planner') {
        
        $username = $_SESSION['username']; 
        $checkQuery = "SELECT * FROM plan WHERE planName = '$planName' AND planner = '$username'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            
            $_SESSION['planName'] = $planName;

            
            header('Location: plan_dashboard.php');
            exit();
        } else {
           
            echo 'Wrong plan name.';
        }
    } else {
        
        $username = $_SESSION['username']; 
        $checkQuery = "SELECT * FROM involved_in WHERE planName = '$planName' AND username = '$username'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            
            $_SESSION['planName'] = $planName;

            
            header('Location: plan_dashboard.php');
            exit();
        } else {
            
            echo 'Wrong plan name.';
        }
    }
} else {
    
    echo 'Invalid request.';
}

$conn->close();
?>


