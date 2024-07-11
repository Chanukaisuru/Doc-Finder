<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Reset Password</h1>
    <form action="process_reset_password.php" method="post" novalidate>
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
        <div>
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
