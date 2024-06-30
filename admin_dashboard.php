<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_name'])) {
    // Redirect to the login page if not logged in
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> <!-- Link to the stylesheet -->
</head>
<body>
    <h1>Welcome, Admin</h1>
    <p>Login successful!</p>
    <!-- Form to redirect to registration_admin -->
    <form action="registration_admin.html" method="get">
        <button type="submit" class="btn btn-primary">Register New Admin</button>
    </form>
    <!-- Form to redirect to process_signup_doctor -->
   <form action="process_signup_doctor.php" method="get">
        <button type="submit" class="btn btn-primary">Add Doctor Details</button>
    </form>

    <form action="feedback_view.php" method="get">
        <button type="submit" class="btn btn-primary">feedback view</button>
    </form>
    
</body>
</html>
