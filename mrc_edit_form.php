<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Time Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            margin-bottom: 10px;
            padding: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php
include 'database_connection.php';

// Check if values are provided in the query parameters
if (!empty($_GET)) {
    $date = $_GET['date_'];
    $startTime = $_GET['start_time'];

    // Fetch data for the specified date_ and start_time from the database
    $sql = "SELECT * FROM time_tab WHERE date_='$date' AND start_time='$startTime'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Retrieve the existing data
        $row = $result->fetch_assoc();
?>
        <h2>Edit Time Entry</h2>
        <form action="mrc_update_entry.php" method="post">
            <input type="hidden" name="date_" value="<?php echo isset($row['date_']) ? $row['date_'] : ''; ?>">
            <input type="hidden" name="start_time" value="<?php echo isset($row['start_time']) ? $row['start_time'] : ''; ?>">
            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo isset($row['date_']) ? $row['date_'] : ''; ?>" required><br>
            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" value="<?php echo isset($row['start_time']) ? $row['start_time'] : ''; ?>" required><br>
            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" value="<?php echo isset($row['end_time']) ? $row['end_time'] : ''; ?>" required><br>
            <label for="activity">Activity:</label>
            <input type="text" name="activity" value="<?php echo isset($row['activity']) ? $row['activity'] : ''; ?>" required><br>
            <label for="location">Location:</label>
            <input type="text" name="location" value="<?php echo isset($row['location_']) ? $row['location_'] : ''; ?>" required><br>
            <input type="submit" value="Update">
        </form>
<?php
    } else {
        echo '<p class="error">Time entry not found.</p>';
    }
} else {
    echo '<p class="error">Invalid request. Please provide date_ and start_time.</p>';
}

// Close the database connection
$conn->close();
?>

</body>
</html>






