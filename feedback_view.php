<?php
// Database connection details
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

    <!-- BOOTSTRAP CDN Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <section id="feedback-section">
        <h1 class="h1-tag">Feedbacks</h1>
        <div class="container">
            <table class="table table-bordered">
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
                        // Output data of each row
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

    <!-- Form to redirect to admin dashboard -->
    <form action="admin_dashboard.html" method="get">
        <button type="submit" class="btn btn-primary">Go to Admin Dashboard</button>
    </form>

</body>

</html>

<?php
$conn->close();
?>
