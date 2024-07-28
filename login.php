<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/login.css">
    <style>
        .message-box .error {
            color: red;
        }
        .message-box .success {
            color: green;
        }
    </style>
</head>
<body>
<div class="headers">
    <a href="home.html" class="logo">
        <div class="lo">
            <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
        </div>
        <div class="log"><p>DOC FINDER</p></div>
    </a>
    <div class="auth-buttons">
        <a href="home.html" class="btn">Home</a>
    </div>
</div>

<div>
    <div class="wrapper">
        <h1>User Login</h1>
         <!-- Display messages -->
         <div class="message-box">
         <div class="message-box">
            <?php
            // Start session
            session_start();

            // Display error message
            if (!empty($_SESSION['error_message'])) {
                echo "<p class='error'>{$_SESSION['error_message']}</p>";
                $_SESSION['error_message'] = ''; 
            }

            // Display success message 
            if (!empty($_SESSION['success_message'])) {
                echo "<p class='success'>{$_SESSION['success_message']}</p>";
                $_SESSION['success_message'] = ''; 
            }
            ?>
            </div>
        </div>
        <form method="post" action="unified_login.php">
            <div class="input-box">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-box">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <p><a href="forgot_password.php">Forgot Password?</a></p>
        </form>
    </div>
</div>
</body>
</html>
