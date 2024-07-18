<?php
include 'database.php';

$specialty = isset($_GET['specialty']) ? $_GET['specialty'] : '';

$sql = "SELECT * FROM doctors";
if ($specialty) {
    $sql .= " WHERE specialty = ?";
}

$stmt = $conn->prepare($sql);

if ($specialty) {
    $stmt->bind_param("s", $specialty);
}

$stmt->execute();
$result = $stmt->get_result();

$doctors = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

echo json_encode($doctors);

$stmt->close();
$conn->close();
?>
