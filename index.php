<?php
session_start();

include 'database_connection.php';

if (isset($_SESSION['planName'])) {
    
    $planName = $_SESSION['planName'];
    $role=$_SESSION['role'];
   
    $sql = "SELECT date_, start_time, end_time, activity, location_ FROM time_tab WHERE planName = '$planName' ORDER BY date_, start_time";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Table - <?php echo $planName; ?></title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #a9c9eb;
            color: #fff;
        }

    .insert-button,
    .edit-button,
    .delete-button {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        font-size: 16px;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    /* Specific styles for the Insert Data button */
    .insert-button {
        background-color: #32e34a; /* Green */
    }

    /* Specific styles for the Edit Data button */
    .edit-button {
        background-color: #008CBA; /* Blue */
    }

    /* Specific styles for the Delete button */
    .delete-button {
        background-color: #d60f16; /* Red */
    }

    /* Hover effect for all buttons */
    .insert-button:hover,
    .edit-button:hover,
    .delete-button:hover {
        background-color: #d39ede; /* Darker green */
    }
    </style>
</head>
<body>

<h2>Time Table - <?php echo $planName; ?></h2>
<h2> Your Role is <?php echo $role; ?></h2>
<?php


if (isset($_SESSION['role']) && $_SESSION['role'] == 'planner') {
    
    echo '<a href="time_table_input.html" class="insert-button">Insert Data</a>';
    echo '<a href="mrc_edit_table.php" class="edit-button">Edit Data</a>';
    echo '<a href="delete_table.php" class="delete-button">Delete</a>';
}
?>
<br>
<?php
    if ($result->num_rows > 0) {
        echo "<table>";
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
        echo '<div style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); text-align: center;">';
        echo '<a href="plan_dashboard.php" class="dashboard-button">Go to Plan Dashboard</a>';
        echo '</div>';

    } else {
        echo "No data found";
    }
} else {
    
    header('Location: login.html');
    exit();
}

$conn->close();
?>

</body>
</html>


