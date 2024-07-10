<?php
// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $password_confirmation = $_POST['password_confirmation'];

    if (empty($email) || empty($new_password) || empty($password_confirmation)) {
        die('Please fill all fields.');
    }

    if ($new_password !== $password_confirmation) {
        die('Passwords do not match.');
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password and clear OTP
    $sql = "UPDATE admins SET password = ?, otp_code = NULL, otp_expires_at = NULL WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    echo "Password reset successful. You can now <a href='home.html'>login</a>.";
}
?>
