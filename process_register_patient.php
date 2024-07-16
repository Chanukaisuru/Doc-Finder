<?php
// Include the database connection file
include 'database.php';

// Get form data
$email = $_POST['email'];
$nic = $_POST['nic'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$age = $_POST['age'];
$phone_no = $_POST['phone_no'];
$address = $_POST['address'];
$province = $_POST['province'];
$sick = $_POST['sick'];

// Check if email already exists in the users table
$sql_check_email = "SELECT user_id FROM users WHERE email = ?";
$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email);
$stmt_check_email->execute();
$result_check_email = $stmt_check_email->get_result();

if ($result_check_email->num_rows > 0) {
    die("Email already registered.");
}

$stmt_check_email->close();

// Insert into users table
$sql_user = "INSERT INTO users (email, user_name, role_no, created_at) VALUES (?, ?, 3, NOW())";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("ss", $email, $first_name);

if ($stmt_user->execute()) {
    $user_id = $stmt_user->insert_id;

    // Check if NIC already exists in the patients table
    $sql_check_nic = "SELECT nic FROM patients WHERE nic = ?";
    $stmt_check_nic = $conn->prepare($sql_check_nic);
    $stmt_check_nic->bind_param("s", $nic);
    $stmt_check_nic->execute();
    $result_check_nic = $stmt_check_nic->get_result();

    if ($result_check_nic->num_rows > 0) {
        die("NIC already registered.");
    }

    $stmt_check_nic->close();

    // Insert into patients table
    $sql_patient = "INSERT INTO patients (nic, user_id, first_name, last_name, age, phone_no, address, district, sick) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_patient = $conn->prepare($sql_patient);
    $stmt_patient->bind_param("sisssssss", $nic, $user_id, $first_name, $last_name, $age, $phone_no, $address, $province, $sick);

    if ($stmt_patient->execute()) {
        echo "Patient registered successfully.";
    } else {
        echo "Error: " . $stmt_patient->error;
    }
} else {
    echo "Error: " . $stmt_user->error;
}

$stmt_user->close();
$stmt_patient->close();
$conn->close();
?>
