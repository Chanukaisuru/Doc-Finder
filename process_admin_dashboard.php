<?php
// Start the session
session_start();

// Check admin  logged 
if (!isset($_SESSION['admin_name'])) {
    
    exit();
}
?>