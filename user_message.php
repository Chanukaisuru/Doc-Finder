<?php
// Include the database connection file
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $message_details = $_POST['message_details'];

    $stmt = $conn->prepare("INSERT INTO messages (full_name, email, message_details) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $email, $message_details);

    if ($stmt->execute()) {
        //header("Location: home.html");
       
        echo "<script>alert('Contact Informatino Submitted Successfully'); window.location.href='home.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
