<?php
// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $otp_code = $_POST['otp_code'];

    if (empty($email) || empty($otp_code)) {
        die('Please fill all fields.');
    }

    // Check if the email and OTP code are valid and the OTP has not expired
    $sql = "SELECT * FROM users WHERE email = ? AND otp_code = ? AND otp_expires_at > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $otp_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Invalid OTP or OTP has expired.');
    }

    // OTP is valid, redirect to reset password page
    header("Location: reset_password.html");
   // echo "<script>alert('OTP verified successfully. Please reset your password.'); window.location.href='reset_password.php?email=$email';</script>";
}
?>
