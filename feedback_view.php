<?php
// Database connection 
include 'database.php';

// Fetch feedbacks
$sql = "SELECT name, email, contact_number, feedback_text, submitted_at FROM feedback ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="resources/css/feedback_view.css">
</head>

<body>
    <div class="headers">
        <a href="#" class="logo">
            <div class="lo">
                <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
            </div> DOC FINDER
        </a>
    </div>

    <section id="feedback-section" class="wrapper">
        <h1>Feedbacks</h1>
        <div class="content-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Feedback</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['contact_number']) . "</td>
                                    <td>" . htmlspecialchars($row['feedback_text']) . "</td>
                                    <td>" . htmlspecialchars($row['submitted_at']) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No feedbacks found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    
    <form action="admin_dashboard.html" method="get">
        <button type="submit" class="btn">Go to Admin Dashboard</button>
    </form>

</body>

</html>

<?php
$conn->close();
?>
