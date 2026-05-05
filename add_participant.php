<?php
session_start();

include 'database_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input
    $usernameToAdd = htmlspecialchars(trim($_POST['usernameToAdd']));

    // Checkinf if the usernameToAdd exists in the user table and has the role "participant"
    $checkUserQuery = "SELECT * FROM users WHERE username = '$usernameToAdd' AND role = 'participant'";
    $resultUser = $conn->query($checkUserQuery);

    if ($resultUser->num_rows > 0) {
        $planName = $_SESSION['planName']; 

        $checkInvolvementQuery = "SELECT * FROM involved_in WHERE planName = '$planName' AND username = '$usernameToAdd'";
        $resultInvolvement = $conn->query($checkInvolvementQuery);

        if ($resultInvolvement->num_rows == 0) {
            // Adding username to the involved_in table
            $insertQuery = "INSERT INTO involved_in (planName, username) VALUES ('$planName', '$usernameToAdd')";
            $conn->query($insertQuery);

            echo 'Username added successfully.';
        } else {
            echo 'Username is already involved in the plan.';
        }
    } else {
        echo 'Username does not exist or is not a participant.';
    }
} else {
    echo 'Invalid request.';
}
echo "</table>";
echo '<div style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); text-align: center;">';
echo '<a href="plan_dashboard.php" class="dashboard-button">Go to Plan Dashboard</a>';
echo '</div>';
$conn->close();
?>

