<?php
session_start();  // Start the session

require 'database.php';  // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin found
        echo "Login successful!";
        // You can set session variables here if needed
        $_SESSION['admin_email'] = $email;
    } else {
        // Admin not found
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
