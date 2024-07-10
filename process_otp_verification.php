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

    $sql = "SELECT * FROM admins WHERE email = ? AND otp_code = ? AND otp_expires_at > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $otp_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Invalid or expired OTP.');
    }

    // OTP is valid, show password reset form
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Reset Password</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <h1>Reset Password</h1>
        <form action="process_reset_password.php" method="post" novalidate>
            <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
            <div>
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div>
                <label for="password_confirmation">Repeat Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </body>
    </html>';
}
?>
