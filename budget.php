
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracket</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f7fafc;
            color: #495057;
        }

        h2 {
            text-align: center;
            color: #04203d;
        }

        .info-container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        strong {
            color: #007BFF;
        }
    .edit-button,
    .update-button {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        font-size: 16px;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-right: 10px;
    }

    /* Styles for the Edit Budget button */
    .edit-button {
        background-color: #2196f3; 
    }

    /* Styles for the Update Spent Money button */
    .update-button {
        background-color: #2196f3; /* Blue */
    }

    /* Hover effect for all buttons */
    .edit-button:hover,
    .update-button:hover {
    background-color: #45a049; /* Darker green for Edit Budget */
    }

    </style>
</head>
<body>

<?php
session_start();
include 'database_connection.php'; 
$planName = $_SESSION['planName'];


$planInfoQuery = "SELECT budget, spent FROM plan WHERE planName = '$planName'";
$result = $conn->query($planInfoQuery);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $budget = $row['budget'];
    $spent = $row['spent'];
    $remainingBudget = $budget - $spent;
    echo "<div class='info-container'>";
    echo "<h2>Budget Information</h2>";
    echo "<p><strong>Budget:</strong> $budget</p>";
    echo "<p><strong>Spent:</strong> $spent</p>";
    echo "<p><strong>Remaining:</strong> $remainingBudget</p>";
    echo "</div>";
} else {
    echo "<div class='info-container'>";
    echo "<p>No plan info found.</p>";
    echo "</div>";
}

echo '<div style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); text-align: center;">';
echo '<a href="plan_dashboard.php" class="dashboard-button">Go to Plan Dashboard</a>';
echo '</div>';
?>
<?php

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];


    if ($role == 'planner') {
        
        echo '<a href="edit_budget.php" class="edit-button">Update Budget</a>';
        echo '<a href="update_spent.php" class="update-button">Update Spent Money</a>';
    }
}
?>


</body>
</html>

