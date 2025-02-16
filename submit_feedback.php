<?php


// Include the database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = $conn->real_escape_string(trim($_POST['full_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $feedback_text = $conn->real_escape_string(trim($_POST['message_details']));

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, feedback_text) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters
    $stmt->bind_param("sss", $name, $email, $feedback_text);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully'); window.location.href='home.html';</script>";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Form not submitted correctly.";
}
?>