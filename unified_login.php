<?php

// Include the database connection file
include 'database.php';

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation
    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = 'Please fill all fields.';
        header("Location: login.php");
        exit();
    }

    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 0) {
        $_SESSION['error_message'] = 'User not found.';
        header("Location: login.php");
        exit();
    }

    $user = $result->fetch_assoc();

    // Verify password
    if (!password_verify($password, $user['password'])) {
        $_SESSION['error_message'] = 'Invalid password.';
        header("Location: login.php");
        exit();
    }

    
    $_SESSION['user_name'] = $user['user_name'];
    $_SESSION['role_no'] = $user['role_no'];

    // Redirect based on role
    if ($user['role_no'] == 1) {
        header("Location: admin_dashboard.html");
        exit();
    } else {
        
        header("Location: user_dashboard.html"); 
        exit();
    }
}
