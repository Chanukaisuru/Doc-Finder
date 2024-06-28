<?php
// Start the session
session_start();

// Include the database connection file
require 'database.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the admin_name and password from the form
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT * FROM admins WHERE admin_name = ? AND password = ?");
    $stmt->bind_param("ss", $admin_name, $password);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching user was found
    if ($result->num_rows > 0) {
        // Set the session variable for the admin
        $_SESSION['admin_name'] = $admin_name;

        // Redirect to the admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // If no match is found, display an error message
        echo "Invalid username or password.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> <!-- Link to the stylesheet -->
</head>
<body>
    <h1>Admin Login</h1>

    <form method="post" action="process_login.php">
        <label for="admin_name">Username</label>
        <input type="text" name="admin_name" id="admin_name" required> <!-- Input field for username -->

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required> <!-- Input field for password -->

        <button type="submit">Log in</button> <!-- Submit button -->
    </form>    
</body>
</html>
