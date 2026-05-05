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
session_start();
include 'database_connection.php';
$planName = $_SESSION['planName'];
// Fetch data from the database
$sql = "SELECT date_, start_time, end_time, activity, location_ FROM time_tab WHERE planName = '$planName' ORDER BY date_, start_time";
$result = $conn->query($sql);
?>

<table border="1">
    <tr>
        <th>Date</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Activity</th>
        <th>Location</th>
        <th>Action</th>
    </tr>

    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['date_'] . "</td>";
        echo "<td>" . $row['start_time'] . "</td>";
        echo "<td>" . $row['end_time'] . "</td>";
        echo "<td>" . $row['activity'] . "</td>";
        echo "<td>" . $row['location_'] . "</td>";
        echo "<td><a href='mrc_edit_form.php?" . http_build_query($row) . "'>Edit</a></td>";
        echo "</tr>";
    }
    ?>

</table>

</body>

</html>


