<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/reset_password.css">
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
            <a href="login.php" class="btn">Login</a>
        </div>
    </div>
    <div class="wrapper">
        <h1>Reset Password</h1>
        <!-- Display messages -->
        <div class="message-box">
            <?php
            // Start session
            session_start();

            // Display error message if any
            if (!empty($_SESSION['error_message'])) {
                echo "<p class='error' style='color: #D8000C; font-size:15px; margin-left: 70px; '>{$_SESSION['error_message']}</p>";
                $_SESSION['error_message'] = '';
            }

            // Display success message if any
            if (!empty($_SESSION['success_message'])) {
                echo "<p class='success' style='color: #D8000C; font-size:15px; margin-left: 70px; '>{$_SESSION['success_message']}</p>";
                $_SESSION['success_message'] = '';
            }
            ?>
        </div>
        <form method="post" action="process_reset_password.php">
            <div class="input-box">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-box">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="input-box">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div><br>
            <input type="submit" class="btn" value="Reset Password">
        </form>
    </div>
</body>
</html>
