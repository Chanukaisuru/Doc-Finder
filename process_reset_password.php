<?php
// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $password_confirmation = $_POST['password_confirmation'];

    // Basic validation
    if (empty($email) || empty($new_password) || empty($password_confirmation)) {
        die('Please fill all fields.');
    }

    if ($new_password !== $password_confirmation) {
        die('Passwords do not match.');
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password and clear OTP
    $sql = "UPDATE users SET password = ?, otp_code = NULL, otp_expires_at = NULL WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        // Redirect to login page after successful reset
        header("Location: login.html");
        exit();
    } else {
        die('Error: ' . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
