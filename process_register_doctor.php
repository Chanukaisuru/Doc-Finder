<?php
// Include the database connection file
include 'database.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$reg_no = $_POST['reg_no'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone_no = $_POST['phone_no'];
$province = $_POST['province'];
$qualification = $_POST['qualification'];
$specialty = $_POST['specialty'];

// Validate passwords
if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

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

// Check if registration number already exists in the doctors table
$sql_check_reg_no = "SELECT reg_no FROM doctors WHERE reg_no = ?";
$stmt_check_reg_no = $conn->prepare($sql_check_reg_no);
$stmt_check_reg_no->bind_param("s", $reg_no);
$stmt_check_reg_no->execute();
$result_check_reg_no = $stmt_check_reg_no->get_result();

if ($result_check_reg_no->num_rows > 0) {
    die("Registration number already registered.");
}

$stmt_check_reg_no->close();

// Insert into users table
$sql_user = "INSERT INTO users (email, user_name, password, role_no, created_at) VALUES (?, ?, ?, 2, NOW())";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("sss", $email, $first_name, $hashed_password);

if ($stmt_user->execute()) {
    $user_id = $stmt_user->insert_id;

    // Insert into doctors table
    $sql_doctor = "INSERT INTO doctors (reg_no, user_id, first_name, last_name, phone_no, province, qualification, specialty) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_doctor = $conn->prepare($sql_doctor);
    $stmt_doctor->bind_param("sissssss", $reg_no, $user_id, $first_name, $last_name, $phone_no, $province, $qualification, $specialty);

    if ($stmt_doctor->execute()) {
        echo "Doctor registered successfully.";
    } else {
        echo "Error: " . $stmt_doctor->error;
    }

    $stmt_doctor->close();
} else {
    echo "Error: " . $stmt_user->error;
}

$stmt_user->close();
$conn->close();
?>
