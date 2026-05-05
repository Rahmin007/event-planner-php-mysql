<?php
// Start a session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or handle unauthorized access
    header('Location: login.html'); // Replace with the actual login page
    exit();
}

// Retrieve session variables
$planName = $_SESSION['planName']; // Replace with the actual session variable name for planName
$username = $_SESSION['username']; // Replace with the actual session variable name for username
$role=$_SESSION['role']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0; /* Set your desired background color */
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }



        .button-container {
            justify-content: space-around;
            margin-top: 20px;
        }

        .dashboard-button {
            display: block;
            /* width: 100%; Remove this line to make the width auto */
            margin-bottom: 10px; /* Add margin between buttons */
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .dashboard-button:hover {
            background-color: #0056b3;
        }



        .profile_button {
            display: block;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007BFF; /* Change the background color as needed */
            color: #fff;
            padding: 10px 20px;
            border-radius: 50%;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .profile_button:hover {
            background-color: #0056b3; /* Change the hover background color as needed */
        }
        .logout-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #0056b3;
        }
    
    </style>
</head>
<body>
<h1>Welcome to <?php echo $planName; ?>, <?php echo $username; ?>!</h1>
<!-- Header with Plan Name and User Name -->
<h2> Your Role is <?php echo $role; ?>
<div class="header">
    <h1>Your Plan Dashboard</h1>

</div>

<!-- Button Container -->
<div class="button-container">
    <a href="index.php" class="dashboard-button">Plan Time Table</a>
    <a href="user_profile.php" class="profile_button">User Profile</a>
    <a href="budget.php" class="dashboard-button">Budget</a>
    <a href="notes.php" class="dashboard-button">Notes & Comments</a>
</div>
<?php

// Check if the session role is set and is equal to 'planner'
if (isset($_SESSION['role']) && $_SESSION['role'] == 'planner') {
    echo '<form action="add_participant.php" method="post">';
    echo '<label for="usernameToAdd"></label>';
    echo '<input type="text" id="usernameToAdd" name="usernameToAdd" required>';
    echo '<button type="submit" class="dashboard-button">Add Participant</button>';
    echo '</form>';
    echo '<a href="participant_info.php" class="dashboard-button">Participants Info</a>';
}
?>
<!-- Your participant dashboard content -->

<?php
// Check if the user is a participant
if (isset($_SESSION['role']) && $_SESSION['role'] == 'participant') {
    echo '<a href="planner_info.php" class="dashboard-button">Planner Info</a>';
}
?>
<a href="logout.php" class="logout-button">Log Out</a>

</body>
</html>

