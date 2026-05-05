<?php
// Start the session (if not started)
session_start();

// Include your database connection code here
include 'database_connection.php'; // Adjust the file name and path as per your setup

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input values
    $date = htmlspecialchars(trim($_POST['date']));
    $startTime = htmlspecialchars(trim($_POST['startTime']));
    $endTime = htmlspecialchars(trim($_POST['endTime']));
    $activity = htmlspecialchars(trim($_POST['activity']));
    $location = htmlspecialchars(trim($_POST['location']));

    // Get the planName from the session
    $planName = $_SESSION['planName'];
    
    $checkQuery = "SELECT * FROM time_tab WHERE planName = '$planName' AND date_ = '$date' AND start_time = '$startTime'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // The combination already exists, you can choose to update the existing record or display an error
        echo '<div style="background-color: #f44336; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">';
        echo "Error: Some Activity already exists at that time. Choose a new Date or Start Time, please.<br>";
        echo '<a href="index.php">Go Back To Time Table</a>';
        echo '</div>';
    } else {
        // Insert data into the database
        $sql = "INSERT INTO time_tab (planName, date_, start_time, end_time, activity, location_) VALUES ('$planName', '$date', '$startTime', '$endTime', '$activity', '$location')";

        if ($conn->query($sql) === TRUE) {
            header('Location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle invalid requests
    echo 'Invalid request.';
}
?>
