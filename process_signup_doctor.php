<?php
// Include the database connection file
include 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $d_name = $_POST['d_name'];
    $d_phone = $_POST['d_phone'];
    $d_email = $_POST['d_email'];
    $qualification = $_POST['qualification'];
    $specilty = $_POST['specilty'];
    $d_reg = $_POST['d_reg'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    // Validate form data
    if (empty($d_name) || empty($d_phone) || empty($d_email) || empty($qualification) || empty($specilty) || empty($d_reg) || empty($password) || empty($password_confirmation)) {
        die('Please fill all required fields.');
    }

    if ($password !== $password_confirmation) {
        die('Passwords do not match.');
    }

    // Check if d_email already exists
    $sql = "SELECT * FROM doctors WHERE d_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $d_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die('Email already exists. Please choose a different email.');
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO doctors (d_name, d_phone, d_email, d_password, qualification, specilty, d_reg) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("sssssss", $d_name, $d_phone, $d_email, $hashed_password, $qualification, $specilty, $d_reg);

    if ($stmt->execute()) {
        // Start the session
        session_start();

        // Set session variable for the doctor
        $_SESSION['d_email'] = $d_email;

        // Redirect to a confirmation or dashboard page after successful signup
        header("Location: home.html");
        exit();
    } else {
        echo 'Error: ' . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctor Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Doctor Signup</h1>
    <form action="process_signup_doctor.php" method="post" novalidate>
        <div>
            <label for="d_name">Doctor's Name</label>
            <input type="text" id="d_name" name="d_name" required>
        </div>
        <div>
            <label for="d_phone">Phone Number</label>
            <input type="text" id="d_phone" name="d_phone" required>
        </div>
        <div>
            <label for="d_email">Email</label>
            <input type="email" id="d_email" name="d_email" required>
        </div>
        <div>
            <label for="qualification">Qualification</label>
            <input type="text" id="qualification" name="qualification" required>
        </div>
        <div>
            <label for="specilty">Specialty</label>
            <input type="text" id="specilty" name="specilty" required>
        </div>
        <div>
            <label for="d_reg">Doctor's Registration Number</label>
            <input type="text" id="d_reg" name="d_reg" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Repeat Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
