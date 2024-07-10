<?php
// Include the database connection file
include 'database.php';

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($admin_name) || empty($password)) {
        die('Please fill all fields.');
    }

    // Prepare SQL query
    $sql = "SELECT * FROM admins WHERE admin_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admin_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin exists
    if ($result->num_rows === 0) {
        die('Admin not found.');
    }

    $admin = $result->fetch_assoc();

    // Verify password
    if (!password_verify($password, $admin['password'])) {
        die('Invalid password.');
    }

    // Set session variable
    $_SESSION['admin_name'] = $admin_name;

    // Redirect to dashboard
    header("Location: admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Admin Login</h1>
    <form method="post">
        <div>
            <label for="admin_name">Admin Name</label>
            <input type="text" id="admin_name" name="admin_name" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <p><a href="forgot_password.php">Forgot Password?</a></p>
</body>
</html>
