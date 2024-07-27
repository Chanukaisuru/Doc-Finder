<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/forgot_password.css">
</head>
<body>
    <div class="headers">
        <a href="home.html" class="logo">
            <div class="lo">
                <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
            </div>
            <div class="log">
                <p>DOC FINDER </p>
            </div>
        </a>
        <div class="auth-buttons">
            <a href="home.html" class="btn">Home</a>
            
        </div>
    </div>

    <div class="wrapper">
        <h1>Forgot Password</h1>
        <!-- Display messages -->
        <div class="message-box">
            <?php
            // Start session
            session_start();

            // Display error message if any
            if (!empty($_SESSION['error_message'])) {
                
                echo "<p class='error' style='color: #D8000C; font-size:15px; margin-left: 83px;'>{$_SESSION['error_message']}</p>";
                $_SESSION['error_message'] = ''; // Clear the message after displaying
            }

            // Display success message if any
            if (!empty($_SESSION['success_message'])) {
                echo "<p class='success'>{$_SESSION['success_message']}</p>";
                $_SESSION['success_message'] = ''; // Clear the message after displaying
            }
            ?>
        </div>
        <form action="process_forgot_password.php" method="post" novalidate>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn">Send</button>
        </form>
    </div>
</body>
</html>
