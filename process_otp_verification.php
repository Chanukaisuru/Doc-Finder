<?php
// Start session
session_start();

// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $otp_code = trim($_POST['otp_code']);

    // Validate input
    if (empty($email) || empty($otp_code)) {
        $_SESSION['error_message'] = 'Please fill all fields.';
        header("Location: otp_verification.php");
        exit();
    }

    // Check if the email and OTP code are valid and the OTP has not expired
    $sql = "SELECT * FROM users WHERE email = ? AND otp_code = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ss", $email, $otp_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['error_message'] = 'Invalid OTP or email.';
        header("Location: otp_verification.php");
        exit();
    } else {
        $user = $result->fetch_assoc();
        $otp_expires_at = $user['otp_expires_at'];

        if (new DateTime($otp_expires_at) < new DateTime()) {
            $_SESSION['error_message'] = 'OTP has expired.';
            header("Location: otp_verification.php");
            exit();
        } else {
            // OTP verified successfully
            $_SESSION['success_message'] = 'OTP verified successfully.';
            header("Location: reset_password.php");
            exit();
        }
    }

    $stmt->close();
}
$conn->close();
?>
