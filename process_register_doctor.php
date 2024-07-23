<?php
// Start session
session_start();

// Include the database connection file
include 'database.php';

// Initialize session variables for messages
$_SESSION['error_message'] = '';
$_SESSION['success_message'] = '';

// Get form data
$email = $_POST['email'];
$reg_no = $_POST['reg_no'];
$name = $_POST['name'];
$phone_no = $_POST['phone_no'];
$district = $_POST['district'];
$hospital = $_POST['hospital'];
$location = $_POST['location'];
$qualification = $_POST['qualification'];
$specialty = $_POST['specialty'];

// Check if email already exists in the users table
$sql_check_email = "SELECT email FROM users WHERE email = ?";
$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email);
$stmt_check_email->execute();
$result_check_email = $stmt_check_email->get_result();

if ($result_check_email->num_rows > 0) {
    $_SESSION['error_message'] = "Email already registered.";
}

// Check if registration number already exists in the doctors table
$sql_check_reg_no = "SELECT reg_no FROM doctors WHERE reg_no = ?";
$stmt_check_reg_no = $conn->prepare($sql_check_reg_no);
$stmt_check_reg_no->bind_param("s", $reg_no);
$stmt_check_reg_no->execute();
$result_check_reg_no = $stmt_check_reg_no->get_result();

if ($result_check_reg_no->num_rows > 0) {
    $_SESSION['error_message'] = "Registration number already registered.";
}

// Handle file upload
if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
    $profile_photo = $_FILES['profile_photo'];
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
    }

    $target_file = $target_dir . basename($profile_photo["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($profile_photo["tmp_name"]);
    if ($check === false) {
        $_SESSION['error_message'] = "File is not an image.";
    }

    // Check file size
    if ($profile_photo["size"] > 500000) {
        $_SESSION['error_message'] = "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $_SESSION['error_message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Attempt to move the uploaded file
    if (!move_uploaded_file($profile_photo["tmp_name"], $target_file)) {
        $_SESSION['error_message'] = "Sorry, there was an error uploading your file.";
    }
} else {
    $_SESSION['error_message'] = "No file was uploaded or there was an error uploading the file.";
}

// Insert into database if no errors
if (empty($_SESSION['error_message'])) {
    // Insert into users table
    $sql_user = "INSERT INTO users (email, user_name, role_no, created_at) VALUES (?, ?, 2, NOW())";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("ss", $email, $name);

    if ($stmt_user->execute()) {
        $user_id = $stmt_user->insert_id;

        // Insert into doctors table
        $sql_doctor = "INSERT INTO doctors (reg_no, user_id, name, phone_no, district, hospital, location, qualification, specialty, profile_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_doctor = $conn->prepare($sql_doctor);
        $stmt_doctor->bind_param("sissssssss", $reg_no, $user_id, $name, $phone_no, $district, $hospital, $location, $qualification, $specialty, $target_file);

        if ($stmt_doctor->execute()) {
            $_SESSION['success_message'] = "Doctor added successfully!";
        } else {
            $_SESSION['error_message'] = "Error: " . $stmt_doctor->error;
        }

        $stmt_doctor->close();
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt_user->error;
    }

    $stmt_user->close();
}

$conn->close();

// Redirect to form page with messages
header("Location: register_doctor.php");
exit();
?>
