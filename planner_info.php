<?php
session_start();
require_once 'database_connection.php';

if ($_SESSION['role'] == 'participant') {
    // Assuming you have the current plan name stored in a session variable
    $planName = $_SESSION['planName'];

    $stmt = $mysqli->prepare("SELECT p.username, p.phone, p.email 
                              FROM planners p
                              INNER JOIN plan pl ON pl.planner = p.username 
                              WHERE pl.planName = ?");
    $stmt->bind_param("s", $planName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Planner Info</title>
        <style>
            .info {
                margin: 20px;
                padding: 20px;
                border: 1px solid #ddd;
            }
            .info p {
                margin: 10px 0;
                padding: 5px;
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h2>Planner Information</h2>
        <div class='info'>
            <p>Username: " . htmlspecialchars($row['username']) . "</p>
            <p>Phone: " . htmlspecialchars($row['phone']) . "</p>
            <p>Email: " . htmlspecialchars($row['email']) . "</p>
        </div>
    </body>
    </html>";

    echo "<a href='plan_dashboard.php' style='text-decoration: none; padding: 10px 20px; background: #4CAF50; color: white; border-radius: 5px; margin-top: 20px; display: inline-block;'>Return to Dashboard</a>";
    
} else {
    echo "Unauthorized access.";
}
?>
