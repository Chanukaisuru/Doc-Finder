<?php
// Include the database connection file
include 'database.php';

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_name = $_POST['user_name'];
    $password = $_POST['u_password'];

    // Basic validation
    if (empty($user_name) || empty($u_password)) {
        die('Please fill all fields.');
    }

    // Prepare SQL query
    $sql = "SELECT * FROM users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 0) {
        die('user not found.');
    }

    $user = $result->fetch_assoc();

    // Verify password
    if (!password_verify($u_password, $user['u_password'])) {
        die('Invalid password.');
    }

    // Set session variable
    $_SESSION['user_name'] = $user_name;

    // Redirect to dashboard
    header("Location: home.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>user Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>User Login</h1>
    <form method="post">
        <div>
            <label for="admin_name">User Name</label>
            <input type="text" id="user_name" name="user_name" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="u_password" name="u_password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
