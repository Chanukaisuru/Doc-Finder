<?php
// Database connection
$host = "localhost";
$dbname = "doc_finder";
$username = "root";
$password = "";

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT reg_no, profile_photo, name, district, specialty, hospital FROM doctors WHERE specialty = 'General Practitioner'";
$result = $conn->query($sql);

$doctors = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

// Return doctors as JSON
echo json_encode($doctors);

// Close the database connection
$conn->close();
?>
