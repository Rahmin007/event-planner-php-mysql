<?php

session_start();


if (!isset($_SESSION['username'])) {

    header('Location: login.html'); 
    echo 'problem logging in';
    exit();
}

$Username =$_SESSION['username'] ;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planner Dashboard</title>
<style>
button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #3498db; /* Set your desired background color */
    color: #fff; /* Set text color */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #2980b9; /* Set your desired hover background color */
}
</style>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($Username); ?>!</h2>


<form method="post" action="process_plan.php">
    <label for="planName">Plan Name:</label>
    <input type="text" name="planName" required>
    <button type="submit">Go to Plan Dashboard</button>
</form>
<?php


if (isset($_SESSION['role']) && $_SESSION['role'] == 'planner') {
    
    echo '<a href="create_plan_form.php"><button>Create New Plan</button></a>';
}
?>


</body>
</html>