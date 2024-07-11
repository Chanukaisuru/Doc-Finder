<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $contact_number = isset($_POST['contact_number']) ? $conn->real_escape_string(trim($_POST['contact_number'])) : '';
    $feedback_text = $conn->real_escape_string(trim($_POST['feedback']));

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, contact_number, feedback_text) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    $stmt->bind_param("ssss", $name, $email, $contact_number, $feedback_text);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully'); window.location.href='home.html';</script>";
        exit();
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
