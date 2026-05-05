<?php
session_start();

include 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input
    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);

    if (isset($_SESSION['planName'])) {
        $planName = $_SESSION['planName'];

        // Check if the combination of planName and note already exists
        $checkQuery = "SELECT * FROM notes WHERE planName = '$planName' AND note = '$note'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // The combination already exists, you can choose to update the existing record or display an error
            echo '<div style="background-color: #f44336; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">';
            echo "Error: Note with the same planName already exists.";
            echo '</div>';
        } else {
            // The combination does not exist, proceed with the insertion
            $insertQuery = "INSERT INTO notes (note, planName) VALUES ('$note', '$planName')";
            
            if ($conn->query($insertQuery) === TRUE) {
                echo '<div style="background-color: #4caf50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">';
                echo "Note added successfully";
                echo '</div>';
                echo '</table>';
                echo '<div style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); text-align: center;">';
                echo '<a href="plan_dashboard.php" style="display: block; text-decoration: none; color: #fff; background-color: #3498db; padding: 10px; border-radius: 5px;">Go to Plan Dashboard</a>';
                echo '</div>';
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Error: Plan name not set in session";
    }
}

else {
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Note</title>
        <style>
            body {
                font-family: "Arial", sans-serif;
                margin: 20px;
                background-color: #f7fafc;
                color: #495057;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
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
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>

    <form action="add_notes.php" method="post">
        <label for="note">Note:</label>
        <input type="text" id="note" name="note" required>

        <button type="submit">Add Note</button>
    </form>

    </body>
    </html>';
}

$conn->close();
?> 

