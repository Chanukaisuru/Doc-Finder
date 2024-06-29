<?php
// Include the database connection file
include 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    // Validate form data (basic validation)
    if (empty($admin_name) || empty($password) || empty($password_confirmation)) {
        die('Please fill all required fields.');
    }

    if ($password !== $password_confirmation) {
        die('Passwords do not match.');
    }

    // Check if admin_name already exists
    $sql = "SELECT * FROM admins WHERE admin_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admin_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die('Admin name already exists. Please choose a different name.');
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO admins (admin_name, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if statement was prepared correctly
    if (!$stmt) {
        die('Prepare failed: (' . $conn->errno . ') ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $admin_name, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        // Start the session
        session_start();

        // Set session variable
        $_SESSION['admin_name'] = $admin_name;

        // Redirect to admin_dashboard.php after successful signup
        header("Location: home.html");
        exit(); // Ensure no further code is executed
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
    <title>Admin Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Admin Signup</h1>
    <form method="post" action="process_registration_admin.php" novalidate>
        <div>
            <label for="admin_name">Admin Name</label>
            <input type="text" id="admin_name" name="admin_name" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Repeat Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
