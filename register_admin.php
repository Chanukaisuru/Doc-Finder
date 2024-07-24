<!DOCTYPE html>
<html>
<head>
    <title>Admin Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/register_admin.css">
</head>
<body>
    <div class="headers">
        <a href="home.html" class="logo">
            <div class="lo">
                <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
            </div> DOC FINDER
        </a>

        <div class="auth-buttons">
            <a href="home.html" class="btn">Home</a>
            <a href="admin_dashboard.html" class="btn">Admin dashboard</a>
        </div>
    </div>
    <div class="wrapper">
        
        <form method="post" action="process_register_admin.php" novalidate>
            <h1>Admin Signup</h1>
            <?php
        session_start();
        if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) {
            echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
            unset($_SESSION['error_message']);
        }
        if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) {
            echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
            unset($_SESSION['success_message']);
        }
        ?>
            <div class="input-box">    
                <label for="admin_name">Admin Name</label>
                <input type="text" id="admin_name" name="admin_name" required>
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-box">
                <label for="password_confirmation">Repeat Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
    </div>
</body>
</html>
