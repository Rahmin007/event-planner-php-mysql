<?php

session_start();
include 'database_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input values
    $planName = htmlspecialchars(trim($_POST['planName']));
    $budget = htmlspecialchars(trim($_POST['budget']));
    $spent = htmlspecialchars(trim($_POST['spent']));
    $plannerUsername=$_SESSION['username'];

    $checkUniqueQuery = "SELECT * FROM plan WHERE planName = '$planName'";
    $result = $conn->query($checkUniqueQuery);

    if ($result->num_rows > 0) {
        
        echo "Error: Plan name '$planName' already exists. Please choose a different name.";
    } else {

        $insertQuery = "INSERT INTO plan (planName,budget, spent, planner) 
                        VALUES ('$planName', '$budget', '$spent', '$plannerUsername')";

        if ($conn->query($insertQuery) === TRUE) {

            echo "Plan created successfully";
            echo '<br><a href="planner_dashboard.php"><button>Go to Dashboard </button></a>';
        } else {
            // Error: Failed to insert plan
            echo "Error: " . $conn->error;
        }
    }


    $conn->close();
}
?>
