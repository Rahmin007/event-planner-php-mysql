<?php
session_start();
require_once 'database_connection.php';

if ($_SESSION['role'] == 'planner') {
    // Assuming you have the current plan name stored in a session variable
    $planName = $_SESSION['planName'];

    $stmt = $mysqli->prepare("SELECT p.username, p.hobby, p.allargy 
                              FROM participants p
                              INNER JOIN involved_in i ON i.username = p.username 
                              WHERE i.planName = ?");
    $stmt->bind_param("s", $planName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Participants Info</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #eaeaea;
            }
        </style>
    </head>
    <body>
        <h2>Participants Information</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Hobby</th>
                <th>Allergy</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['username']) . "</td>
                <td>" . htmlspecialchars($row['hobby']) . "</td>
                <td>" . htmlspecialchars($row['allargy']) . "</td>
              </tr>";
    }
    
    echo "</table>
    
    </body>
    </html>";
    echo "<a href='plan_dashboard.php' style='text-decoration: none; padding: 10px 20px; background: #4CAF50; color: white; border-radius: 5px; margin-top: 20px; display: inline-block;'>Return to Dashboard</a>";
    
} else {
    echo "Unauthorized access.";
}
?>
