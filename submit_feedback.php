<?php
// Database connection details
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
    $feedback_text = $_POST['feedback_text'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, contact_number, feedback_text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $contact_number, $feedback_text);

    // Execute the statement
    if ($stmt->execute()) {
       // echo "New feedback submitted successfully";
        echo "<script>alert('Feedback submitted successfully'); window.location.href='home.html';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>