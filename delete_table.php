<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table for deletion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
include 'database_connection.php'; 
session_start();
$planName = $_SESSION['planName'];
$sql = "SELECT date_, start_time, end_time, activity, location_ FROM time_tab WHERE planName = '$planName' ORDER BY date_, start_time";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr><th>Date</th><th>Start Time</th><th>End Time</th><th>Activity</th><th>Location</th><th>Action</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["date_"] . '</td>';
        echo '<td>' . $row["start_time"] . '</td>';
        echo '<td>' . $row["end_time"] . '</td>';
        echo '<td>' . $row["activity"] . '</td>';
        echo '<td>' . $row["location_"] . '</td>';
        echo '<td><a href="delete_entry.php?date_=' . $row["date_"] . '&start_time=' . $row["start_time"] . '">Delete</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No records found';
}

$conn->close();
?>

</table>

</body>

</html>