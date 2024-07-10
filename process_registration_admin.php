<?php
// Include the database connection file
include 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $admin_name = $_POST['admin_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    // Validate form data
    if (empty($admin_name) || empty($email) || empty($password) || empty($password_confirmation)) {
        die('Please fill all required fields.');
    }

    if ($password !== $password_confirmation) {
        die('Passwords do not match.');
    }

    // Check if admin_name or email already exists
    $sql = "SELECT * FROM admins WHERE admin_name = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $admin_name, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die('Admin name or email already exists. Please choose different ones.');
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO admins (admin_name, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Prepare failed: (' . $conn->errno . ') ' . $conn->error);
    }

    $stmt->bind_param("sss", $admin_name, $hashed_password, $email);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['admin_name'] = $admin_name;
        header("Location: home.html");
        exit();
    } else {
        echo 'Error: ' . $stmt->error;
    }

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
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
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
