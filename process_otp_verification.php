<?php
// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $otp_code = trim($_POST['otp_code']);

    // Validate input
    if (empty($email) || empty($otp_code)) {
        die('Please fill all fields.');
    }

    // Debug: Print input values (comment out after debugging)
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "OTP Code: " . htmlspecialchars($otp_code) . "<br>";

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
        die('Invalid OTP or email.');
    } else {
        $user = $result->fetch_assoc();
        $otp_expires_at = $user['otp_expires_at'];

        // Debug: Print OTP expiration time
        echo "OTP Expires At: " . $otp_expires_at . "<br>";

        if (new DateTime($otp_expires_at) < new DateTime()) {
            die('OTP has expired.');
        } else {
            // OTP is valid, redirect to reset password page
            echo "<script>alert('OTP verified successfully. Please reset your password.'); window.location.href='reset_password.html;</script>";
        }
    }

    $stmt->close();
}
$conn->close();
?>
