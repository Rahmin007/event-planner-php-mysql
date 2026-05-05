<?php
session_start();

$message = ""; // Empty message string, will hold the confirmation text if update is successful

if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    require_once 'database_connection.php';

    if (!isset($mysqli) || !($mysqli instanceof mysqli)) {
        die("Database connection error.");
    }

    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        // Handle the post data from the form submission
        if ($role == 'participant') {
            // Prepare an update statement
            $stmt = $mysqli->prepare("UPDATE participants SET hobby=?, allargy=? WHERE username=?");
            $stmt->bind_param("sss", $_POST['hobby'], $_POST['allargy'], $username);
        } elseif ($role == 'planner') {
            // Prepare an update statement
            $stmt = $mysqli->prepare("UPDATE planners SET phone=?, email=? WHERE username=?");
            $stmt->bind_param("iss", $_POST['phone'], $_POST['email'], $username);
        }

        if ($stmt->execute()) {
            $message = "Your information has been saved.";
        }
        $stmt->close();
    }

    // Fetch the current information to pre-fill the form
    if ($role == 'participant') {
        $stmt = $mysqli->prepare("SELECT username, hobby, allargy FROM participants WHERE username = ?");
    } elseif ($role == 'planner') {
        $stmt = $mysqli->prepare("SELECT username, phone, email FROM planners WHERE username = ?");
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($db_username, $field1, $field2);
    $stmt->fetch();
    $stmt->close();

    // Start HTML output
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>User Profile</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .profile { margin: 20px; padding: 20px; border: 1px solid #ddd; }
            h1 { color: #333; }
            input[type='text'], input[type='email'], input[type='tel'], input[type='submit'] {
                display: block;
                margin-bottom: 10px;
                padding: 10px 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            input[type='submit'] {
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
            }
            input[type='submit']:hover {
                background-color: #45a049;
            }
            .return-button {
                background-color: #f4f4f4;
                color: #333;
                text-decoration: none;
                padding: 10px 20px;
                border: 1px solid #ccc;
                display: inline-block;
                border-radius: 4px;
            }
            .return-button:hover {
                background-color: #e2e2e2;
            }
            .info-message {
                font-size: 0.9em;
                color: green;
            }
        </style>
    </head>
    <body>
        <div class='profile'>
            <h1>User Profile</h1>
            <form action='' method='post'>
                <label for='username'>Username:</label>
                <input type='text' id='username' name='username' value='".htmlspecialchars($db_username)."' disabled>
                ";

    // Form fields for participant or planner
    if ($role == 'participant') {
        echo "
                <label for='hobby'>Hobby:</label>
                <input type='text' id='hobby' name='hobby' value='".htmlspecialchars($field1)."'>
                <label for='allargy'>Allergy:</label>
                <input type='text' id='allargy' name='allargy' value='".htmlspecialchars($field2)."'>
            ";
    } else {
        echo "
                <label for='phone'>Phone:</label>
                <input type='tel' id='phone' name='phone' value='".htmlspecialchars($field1)."'>
                <label for='email'>Email:</label>
                <input type='email' id='email' name='email' value='".htmlspecialchars($field2)."'>
            ";
    }

    // Update Information button
    echo "
                <input type='submit' name='update' value='Update Information'>
            </form>
            <a href='plan_dashboard.php' class='return-button'>Return to Dashboard</a>
            <div class='info-message'>$message</div>
        </div>
    </body>
    </html>";
} else {
    header('Location: login.php');
    exit;
}
?>
