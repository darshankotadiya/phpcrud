<?php
$servername = "localhost";
$username = "root";  // Change this if needed
$password = "";      // Change this if needed
$dbname = "darshan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
