<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission complete</title>
    <style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 20px;
}


h2 {
    color: #0b3311; 
}

p {
    margin: 10px 0;
}

strong {
    font-weight: bold;
}

button {
    background-color: #0e77c7; 
    color: #fff;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
}

button:hover {
    background-color: #218838; /* Darker green on hover */
}

    </style>
</head>
<body>
    
</body>
</html>
<?php
// Check if data is present in the URL parameters
if (isset($_GET['date']) && isset($_GET['startTime']) && isset($_GET['endTime']) && isset($_GET['activity']) && isset($_GET['location'])) {
    // Retrieve data from URL parameters
    $date = $_GET['date'];
    $startTime = $_GET['startTime'];
    $endTime = $_GET['endTime'];
    $activity = $_GET['activity'];
    $location = $_GET['location'];

    // Display the submitted data
    echo "<h2>Submitted Data:</h2>";
    echo "<p><strong>Date:</strong> $date</p>";
    echo "<p><strong>Start Time:</strong> $startTime</p>";
    echo "<p><strong>End Time:</strong> $endTime</p>";
    echo "<p><strong>Activity:</strong> $activity</p>";
    echo "<p><strong>Location:</strong> $location</p>";
    echo '<br><a href="index.php"><button>Go Back to the Table</button></a>';
} 
else {
    // Redirect to the form page if data is not present
    header('Location: time_table_input.html');
    exit();
}
?>