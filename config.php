<?php
$servername = "localhost";
$username = "root";  // Corrected the typo here
$password = "";
$dbname = "customer_management";

// Create the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully!";

