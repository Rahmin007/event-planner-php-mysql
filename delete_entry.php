<?php
include 'database_connection.php';


if(isset($_GET['date_']) && isset($_GET['start_time'])) {
    $date = $_GET['date_'];
    $startTime = $_GET['start_time'];


    $sql = "DELETE FROM time_tab WHERE date_='$date' AND start_time='$startTime'";

    if ($conn->query($sql) === TRUE) {
        echo '<div style="background-color: #9df9ef; padding: 10px; border-radius: 5px;">';
        echo '<p style="color: #333; font-size: 18px;">Record deleted successfully</p>';
        echo '<a href="index.php" style="text-decoration: none;">';
        echo '<button style="padding: 8px 16px; background-color: #2ecc71; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Go Back to the Table</button>';
        echo '</a>';
        echo '</div>';
        
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo 'Invalid request. Please provide date_ and start_time.';
}


$conn->close();
?>
