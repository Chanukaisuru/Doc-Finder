<?php
// unified_login.php
// Include the database connection file
include 'database.php';

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($email) || empty($password)) {
        die('Please fill all fields.');
    }

    // Prepare SQL query
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 0) {
        die('User not found.');
    }

    $user = $result->fetch_assoc();

    // Verify password
    if (!password_verify($password, $user['password'])) {
        die('Invalid password.');
    }

    // Set session variables based on role
    $_SESSION['user_name'] = $user['user_name'];
    $_SESSION['role_no'] = $user['role_no'];

    // Redirect based on role
    if ($user['role_no'] == 1) {
        header("Location: admin_dashboard.html");
    } elseif ($user['role_no'] == 2) {
        header("Location: doctor_dashboard.php");
    } elseif ($user['role_no'] == 3) {
        header("Location: patient_dashboard.php");
    } else {
        die('Invalid role.');
    }
    exit();
}
?>

