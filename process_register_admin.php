<?php
// Include the database connection file
include 'database.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation']; // Updated to match the form field name

// Validate passwords
if ($password !== $password_confirmation) {
    die("Passwords do not match.");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check the number of existing admins
$sql_check_admin_count = "SELECT COUNT(*) AS admin_count FROM users WHERE role_no = 1";
$result_check_admin_count = $conn->query($sql_check_admin_count);

if ($result_check_admin_count->num_rows > 0) {
    $row = $result_check_admin_count->fetch_assoc();
    if ($row['admin_count'] >= 3) {
        die("Maximum number of admins (3) already registered.");
    }
}

// Check if email already exists in the users table
$sql_check_email = "SELECT email FROM users WHERE email = ?";
$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email);
$stmt_check_email->execute();
$result_check_email = $stmt_check_email->get_result();

if ($result_check_email->num_rows > 0) {
    die("Email already registered.");
}

$stmt_check_email->close();

// Insert into users table
$sql_user = "INSERT INTO users (email, user_name, password, role_no, created_at) VALUES (?, 'admin', ?, 1, NOW())";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("ss", $email, $hashed_password);

if ($stmt_user->execute()) {
    header("Location:login.html");
} else {
    echo "Error: " . $stmt_user->error;
}

$stmt_user->close();
$conn->close();
?>
