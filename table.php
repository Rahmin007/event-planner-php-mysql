<?php
session_start();

include 'database_connection.php';

if (isset($_SESSION['planName'])) 
    $planName = $_SESSION['planName'];
    $role = $_SESSION['role'];
   
    $sql = "SELECT date_, start_time, end_time, activity, location_ FROM time_tab WHERE planName = '$planName' ORDER BY date_, start_time";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Table - <?php echo $planName; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Time Table - <?php echo $planName; ?></h2>
    <h2>Your Role is <?php echo $role; ?></h2>

    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'planner') {
        echo '<div class="button-container">';
        echo '<a href="time_table_input.html" class="insert-button">Insert Data</a>';
        echo '<a href="mrc_edit_table.php" class="edit-button">Edit Data</a>';
        echo '<a href="delete_table.php" class="delete-button">Delete</a>';
        echo '</div>';
    }
    ?>

    <br>

    <?php
    if ($result->num_rows > 0) {
        echo "<table class='timetable'>";
        echo "<tr><th>Date</th><th>Start Time</th><th>End Time</th><th>Activity</th><th>Location</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["date_"] . "</td>";
            echo "<td>" . $row["start_time"] . "</td>";
            echo "<td>" . $row["end_time"] . "</td>";
            echo "<td>" . $row["activity"] . "</td>";
            echo "<td>" . $row["location_"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo '<div class="dashboard-link">';
        echo '<a href="plan_dashboard.php" class="dashboard-button">Go to Plan Dashboard</a>';
        echo '</div>';
    } else {
        echo "<p class='no-data'>No data found</p>";
    }
    ?>

</div>

</body>
</html>



