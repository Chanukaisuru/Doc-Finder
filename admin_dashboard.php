<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_name'])) {
    // Redirect to the login page if not logged in
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> <!-- Link to the stylesheet -->
</head>
<body>
    <h1>Welcome, Admin</h1>
    <p>Login successful!</p>
    <a href="registration_admin.html">Register New Admin</a>
    <p><a href="process_signup_doctor.php">Add Doctor Details</a></p>
</body>
</html>
