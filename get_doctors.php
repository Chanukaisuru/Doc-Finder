<?php
include 'database.php';

$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);

$doctors = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

echo json_encode($doctors);

$conn->close();
?>
