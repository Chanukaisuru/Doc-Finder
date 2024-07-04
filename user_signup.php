<?php
// Include the database connection file
include 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $u_name = $_POST['u_name'];
    $u_phone = $_POST['u_phone'];
    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password'];
    $password_confirmation = $_POST['u_password_confirmation'];

    // Validate form data
    if (empty($u_name) || empty($u_phone) || empty($u_email) || empty($u_password) || empty($password_confirmation)) {
        die('Please fill all required fields.');
    }

    if ($u_password !== $password_confirmation) {
        die('Passwords do not match.');
    }

    // Check if u_email already exists
    $sql = "SELECT * FROM users WHERE u_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $u_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die('Email already exists. Please choose a different email.');
    }

    // Hash the password
    $hashed_password = password_hash($u_password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (u_name, u_phone, u_email, u_password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("ssss", $u_name, $u_phone, $u_email, $hashed_password);

    if ($stmt->execute()) {
        // Start the session
        session_start();

        // Set session variable for the user
        $_SESSION['u_email'] = $u_email;

        // Redirect to a confirmation or dashboard page after successful signup
        echo "<script>alert('Signup successful'); window.location.href='home.html';</script>";
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
    <title>User Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>User Signup</h1>
    <form method="post" novalidate>
        <div>
            <label for="u_name">User's Name</label>
            <input type="text" id="u_name" name="u_name" required>
        </div>
        <div>
            <label for="u_phone">Phone Number</label>
            <input type="text" id="u_phone" name="u_phone" required>
        </div>
        <div>
            <label for="u_email">Email</label>
            <input type="email" id="u_email" name="u_email" required>
        </div>
        <div>
            <label for="u_password">Password</label>
            <input type="password" id="u_password" name="u_password" required>
        </div>
        <div>
            <label for="u_password_confirmation">Repeat Password</label>
            <input type="password" id="u_password_confirmation" name="u_password_confirmation" required>
        </div>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
