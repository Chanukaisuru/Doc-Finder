<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_name'])) {
    // Redirect to the login page if not logged in
    //header("Location: admin_login.html");
    exit();
}
?>