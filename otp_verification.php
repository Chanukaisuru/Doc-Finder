<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/otp_verification.css">
</head>
<body>
    <div class="headers">
        <a href="home.html" class="logo">
            <div class="lo">
                <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
                </div>
                <div class = "log"><p>DOC FINDER </p>
            </div>
        </a>
        <div class="auth-buttons">
            <a href="login.html" class="btn">Log in</a>
        </div>
    </div>
    <div class="wrapper">
        <h1>Verify OTP</h1>
        <!-- Display messages -->
        <div class="message-box">
            <?php
            // Start session
            session_start();

            // Display error message if any
            if (!empty($_SESSION['error_message'])) {
                echo "<p class='error' style='color: #D8000C; font-size:15px; margin-left: 100px; '>{$_SESSION['error_message']}</p>";
                $_SESSION['error_message'] = ''; 
            }

            // Display success message if any
            if (!empty($_SESSION['success_message'])) {
                echo "<p class='success'>{$_SESSION['success_message']}</p>";
                $_SESSION['success_message'] = ''; 
            }
            ?>
        </div>
        <form action="process_otp_verification.php" method="post" novalidate>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-box">
                <label for="otp_code">OTP Code</label>
                <input type="text" id="otp_code" name="otp_code" required>
            </div>
            <button type="submit" class="btn">Verify OTP</button>
        </form>
    </div>
</body>
</html>
