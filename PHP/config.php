<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "booking_system";  // Ensure no space in database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (recommended for database interactions)
$conn->set_charset("utf8mb4");

// Enable error reporting for debugging (optional)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>
