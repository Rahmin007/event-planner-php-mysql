<?php

session_start();

if (!isset($_SESSION['username'])) {

    header('Location: login.html'); 
    exit();
}

$plannerUsername = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Plan</title>
    <!-- Add your CSS styling here -->
    <style>
        
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
        }

        button {
            background-color: #9df9ef;
            color: #000;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Create New Plan</h2>


<form method="post" action="create_plan_process.php">
    <label for="planName">Plan Name:</label>
    <input type="text" name="planName" required>
    <br>

    <label for="budget">Budget:</label>
    <input type="text" name="budget">
    <br>

    <label for="spent">Spent:</label>
    <input type="text" name="spent">
    <br>

    <button type="submit">Create Plan</button>
</form>

</body>
</html>
