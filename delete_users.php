<?php
// Include the database connection file
include 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $u_email = $_POST['email']; // Updated to match the HTML form

    // Validate form data (basic validation)
    if (empty($u_email)) {
        die('Please provide the email address.');
    }

    // Prepare a SQL statement to check if the email exists
    $sql = "SELECT * FROM admins WHERE email = ?"; // Updated column name
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $u_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('No admin found with the provided email address.');
    }

    // Prepare a SQL statement to delete the user
    $sql = "DELETE FROM admins WHERE email = ?"; // Updated column name
    $stmt = $conn->prepare($sql);

    // Check if statement was prepared correctly
    if (!$stmt) {
        die('Prepare failed: (' . $conn->errno . ') ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $u_email);

    // Execute the statement
    if ($stmt->execute()) {
        echo 'Admin deleted successfully.';
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
    <title>Delete Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Delete Users</h1>
    <form method="post" novalidate>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit">Delete User</button>
    </form>
</body>
</html>
