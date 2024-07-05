<?php
// Include the database connection file
include 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $d_reg = $_POST['d_reg'];

    // Validate form data
    if (empty($d_reg)) {
        die('Please provide the doctor\'s corect registation number.');
    }

    // Prepare the delete statement
    $sql = "DELETE FROM doctors WHERE d_reg = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("s", $d_reg);

    if ($stmt->execute()) {
        // Check if any row was affected
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Doctor details deleted successfully.'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('No doctor found with that registation number.'); window.location.href='delete_doctor.php';</script>";
        }
        exit();
    } else {
        echo 'Error: ' . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Doctor</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Delete Doctor</h1>
    <form action="delete_doctor.php" method="post" novalidate>
        <div>
            <label for="d_reg">Doctor's registation number</label>
            <input type="text" id="d_reg" name="d_reg" required>
        </div>
        <button type="submit">Delete</button>
    </form>
</body>
</html>
