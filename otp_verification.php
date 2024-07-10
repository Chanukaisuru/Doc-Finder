<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Verify OTP</h1>
    <form action="process_otp_verification.php" method="post" novalidate>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="otp_code">OTP Code</label>
            <input type="text" id="otp_code" name="otp_code" required>
        </div>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
