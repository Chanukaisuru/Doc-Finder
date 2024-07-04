<?php
// Database connection parameters
$host = "localhost";
$dbname = "doc_finder";
$username = "root";
$password = "";

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Display an error message if the connection fails
}
?>
