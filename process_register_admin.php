<?php
session_start();
include 'database.php';


$_SESSION['error_message'] = '';
$_SESSION['success_message'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    // Validate passwords
    if ($password !== $password_confirmation) {
        $_SESSION['error_message'] = "Passwords do not match.";
        header("Location: register_admin.php");
        exit();
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check the number of existing admins
    $sql_check_admin_count = "SELECT COUNT(*) AS admin_count FROM users WHERE role_no = 1";
    $result_check_admin_count = $conn->query($sql_check_admin_count);

    if ($result_check_admin_count === FALSE) {
        $_SESSION['error_message'] = "Database error: " . $conn->error;
        header("Location: register_admin.php");
        exit();
    }

    $row = $result_check_admin_count->fetch_assoc();
    if ($row['admin_count'] >= 3) {
        $_SESSION['error_message'] = "Maximum number of admins 3 already registered.";
        header("Location: register_admin.php");
        exit();
    }

    // Check if email already exists
    $sql_check_email = "SELECT email FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    if ($stmt_check_email === FALSE) {
        $_SESSION['error_message'] = "Database error: " . $conn->error;
        header("Location: register_admin.php");
        exit();
    }

    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();

    if ($result_check_email === FALSE) {
        $_SESSION['error_message'] = "Database error: " . $conn->error;
        $stmt_check_email->close();
        header("Location: register_admin.php");
        exit();
    }

    if ($result_check_email->num_rows > 0) {
        $_SESSION['error_message'] = "Email already registered.";
        $stmt_check_email->close();
        header("Location: register_admin.php");
        exit();
    }

    $stmt_check_email->close();

    // Insert into users table
    $sql_user = "INSERT INTO users (email, user_name, password, role_no, created_at) VALUES (?, 'admin', ?, 1, NOW())";
    $stmt_user = $conn->prepare($sql_user);
    if ($stmt_user === FALSE) {
        $_SESSION['error_message'] = "Database error: " . $conn->error;
        header("Location: register_admin.php");
        exit();
    }

    $stmt_user->bind_param("ss", $email, $hashed_password);

    if ($stmt_user->execute()) {
        $_SESSION['success_message'] = "Admin registered successfully!";
        header("Location: login.php");
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt_user->error;
        header("Location: register_admin.php"); //change location
    }

    $stmt_user->close();
    $conn->close();
} else {
    header("Location: register_admin.php");
}
?>
