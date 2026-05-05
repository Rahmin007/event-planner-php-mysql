
<?php
include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $date = $_POST['date'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    $activity = $_POST['activity'];
    $location = $_POST['location'];

    $sql = "UPDATE time_tab SET end_time='$endTime', activity='$activity', location_='$location' WHERE date_='$date' AND start_time='$startTime'";

    if ($conn->query($sql) === TRUE) {
        echo '<div style="background-color: #9df9ef; padding: 10px; border-radius: 5px;">';
        echo '<p style="color: #333; font-size: 18px;">Record Edited successfully</p>';
        echo '<a href="index.php" style="text-decoration: none;">';
        echo '<button style="padding: 8px 16px; background-color: #2ecc71; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Go Back to the Table</button>';
        echo '</a>';
        echo '</div>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

