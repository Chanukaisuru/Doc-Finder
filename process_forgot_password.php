<?php
// Include the database connection file
include 'database.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (empty($email)) {
        die('Please fill all fields.');
    }

    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Admin not found.');
    }

    $admin = $result->fetch_assoc();

    // Generate OTP code
    $otp_code = rand(100000, 999999);
    $otp_expires_at = date("Y-m-d H:i:s", strtotime('+15 minutes')); // OTP valid for 15 minutes

    // Update admin with OTP code and expiration time
    $sql = "UPDATE admins SET otp_code = ?, otp_expires_at = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $otp_code, $otp_expires_at, $email);
    $stmt->execute();

    $subject = "Password Reset OTP";
    $message = "Your OTP code for password reset is: <strong>$otp_code</strong>. This code is valid for 15 minutes.";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'docfinder2001@gmail.com';
        $mail->Password = 'kxag lwqe gark jwfm';
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
