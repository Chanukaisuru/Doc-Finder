<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = $conn->real_escape_string(trim($_POST['full_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $contact_number = ''; // If contact number is not in the form, remove this line.
    $feedback_text = $conn->real_escape_string(trim($_POST['message_details']));

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, contact_number, feedback_text) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $contact_number, $feedback_text);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully'); window.location.href='home.html';</script>";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Form not submitted correctly.";
}
?>
