<?php
include 'database_connection.php';
$username = $_POST['username'];
$password = $_POST['password'];
$age = $_POST['age'];
$role = $_POST['role'];

// Check if the username already exists
$checkQuery = "SELECT username FROM users WHERE username = '$username'";
$result = $conn->query($checkQuery);

if ($result->num_rows > 0) {
    // Username already exists, handle the error
    echo "Error: Username already exists. Please choose a different username.";
    echo '<br><a href="signup_form.html"><button>Go Back to the sign-up form </button></a>';
} 
else {
    $insertQuery = "INSERT INTO users (username, password, age, role) VALUES ('$username', '$password', $age, '$role')";


    $insertResult = $conn->query($insertQuery);

    if (!$insertResult) {
        die("Error inserting into users table: " . $conn->error);
    }

    if ($role === 'planner') {
        $insert2 = "INSERT INTO planners (username) SELECT username FROM users WHERE role = 'planner' AND username = '$username'";
        $insert2Result = $conn->query($insert2);


        if (!$insert2Result) {
            die("Error inserting into planners table: " . $conn->error);
        }
    }

    if ($role === 'participant') {
        $insert3 = "INSERT INTO participants (username) SELECT username FROM users WHERE role = 'participant' AND username = '$username'";
        $insert3Result = $conn->query($insert3);

        
        if (!$insert3Result) {
            die("Error inserting into participants table: " . $conn->error);
        }
    }

   
    echo "Signup successful";

    echo '<br><a href="login.html"><button>Go to log in page </button></a>';
    
    
    $conn->close();
}
?>

