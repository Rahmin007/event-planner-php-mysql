<?php
session_start();

include 'database_connection.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input
    $newBudget = htmlspecialchars(trim($_POST['newBudget']));

    
    $planName = $_SESSION['planName'];
    $updateQuery = "UPDATE plan SET budget = '$newBudget' WHERE planName = '$planName'";
    
    if ($conn->query($updateQuery) === TRUE) {
        echo "Budget updated successfully.";
        echo '<a href="budget.php" class="dashboard-button">Go to Budget</a>';
    } else {
        echo "Error updating budget: " . $conn->error;
    }

    
    $conn->close();
} else {
    
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Budget</title>
        <!-- Add your CSS styling here -->
        <style>
            body {
                font-family: \'Arial\', sans-serif;
                margin: 20px;
                background-color: #f7fafc;
                color: #495057;
            }

            form {
                max-width: 400px;
                margin: auto;
                background-color: #fff;
                padding: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            label {
                display: block;
                margin-bottom: 10px;
            }

            input {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                box-sizing: border-box;
            }

            button {
                background-color: #007BFF;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <form method="post" action="">
            <label for="newBudget">New Budget:</label>
            <input type="number" id="newBudget" name="newBudget" required>

            <button type="submit">Update Budget</button>
        </form>
    </body>
    </html>
    ';
}
?>
