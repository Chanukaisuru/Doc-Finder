<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_name'])) {
    
    exit();
}
?>