<?php
// Include Composer's autoloader
require 'vendor/autoload.php';

// Include the database connection file
include 'database.php';

// Use PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (empty($email)) {
        die('Please fill all fields.');
    }

    // Check if the email exists in the users table
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('User not found.');
    }

    $user = $result->fetch_assoc();

    // Generate OTP code
    $otp_code = rand(100000, 999999);
    $otp_expires_at = date("Y-m-d H:i:s", strtotime('+15 minutes')); // OTP valid for 15 minutes

    // Update user with OTP code and expiration time
    $sql = "UPDATE users SET otp_code = ?, otp_expires_at = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $otp_code, $otp_expires_at, $email);
    $stmt->execute();

    // Read email template
    $template = file_get_contents('email_template.html');

    // Replace placeholder with actual OTP code
    $message = str_replace('{{OTP_CODE}}', $otp_code, $template);

    $subject = "Password Reset OTP";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'docfinder2001@gmail.com'; // Replace with your email
        $mail->Password = 'kxag lwqe gark jwfm'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('no-reply@yourdomain.com', 'Your App Name');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo "OTP sent to your email.";
        echo "<script>alert('OTP sent. Please check your email.'); window.location.href='otp_verification.php';</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
