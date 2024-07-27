<?php
// Start session
session_start();

// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $password_confirmation = trim($_POST['password_confirmation']);

    
    if (empty($email) || empty($new_password) || empty($password_confirmation)) {
        $_SESSION['error_message'] = 'Please fill all fields.';
        header("Location: reset_password.php");
        exit();
    }

    if ($new_password !== $password_confirmation) {
        $_SESSION['error_message'] = 'Passwords do not match.';
        header("Location: reset_password.php");
        exit();
    }

    // Check if the email belongs to an admin user
    $sql = "SELECT role_no FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['error_message'] = 'User not found.';
        header("Location: reset_password.php");
        exit();
    } else {
        $user = $result->fetch_assoc();
        if ($user['role_no'] != 1) {
            $_SESSION['error_message'] = 'Permission denied. Only admin users can reset their password.';
            header("Location: reset_password.php");
            exit();
        }
    }

    
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password and clear OTP
    $sql = "UPDATE users SET password = ?, otp_code = NULL, otp_expires_at = NULL WHERE email = ? AND role_no = 1";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ss", $hashed_password, $email);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Password reset successfully. Please log in with your new password.';
        header("Location: login.html");
        exit();
    } else {
        $_SESSION['error_message'] = 'Error updating password. Please try again.';
        header("Location: reset_password.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
