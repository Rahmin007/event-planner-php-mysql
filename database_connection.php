<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "370project";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mysqli = new mysqli('localhost', $username, $password, $dbname);

// Check for errors
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
