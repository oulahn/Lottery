<?php
$servername = "localhost";
$username = "oulahn";
$password = "Password@123#";
$dbname = "LottoDB";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>