<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_management";

// Create a secure database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection with error logging
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Unable to connect to the database. Please try again later.");
}

// Optional: Set character encoding
$conn->set_charset("utf8mb4");
?>
