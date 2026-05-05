<?php
// Start the session (if not started)
session_start();

// Include your database connection code here
include 'database_connection.php'; // Adjust the file name and path as per your setup

// Check if the session planName is set
if (isset($_SESSION['planName'])) {
    // Get the planName from the session
    $planName = $_SESSION['planName'];

    // Fetch notes from the database for the given planName
    $sql = "SELECT note FROM notes WHERE planName = '$planName'";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notes</title>
    <!-- Add your CSS styling here -->
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            padding: 15px;
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
    </style>
</head>
<body>

<h2>Notes for Plan: <?php echo $planName; ?></h2>

<ul>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["note"] . "</li>";
        }
    } else {
        echo "<li>No notes found</li>";
    }
    ?>
</ul>
<a href="add_notes.php" class="dashboard-button">Add Notes</a>
</body>
</html>

<?php
} else {
    // Handle the case when planName is not set in the session
    echo "Error: Plan name not set in session";
}
echo '<div style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); text-align: center;">';
echo '<a href="plan_dashboard.php" class="dashboard-button">Go to Plan Dashboard</a>';
echo '</div>';
// Close the database connection
$conn->close();
?>
