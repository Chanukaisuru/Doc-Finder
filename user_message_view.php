<?php
// Include the database connection file
include 'database.php';

// Fetch messages
$sql = "SELECT full_name, email, message_details, created_at FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages</title>
    <link rel="stylesheet" href="resources/css/user_message.css">
</head>

<body>
    <div class="headers">
        <a href="home.html" class="logo">
            <div class="lo">
                <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
            </div> DOC FINDER
        </a>
    </div>

    <section id="message-section" class="wrapper">
        <h1>User Messages</h1>
        <div class="content-table">
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Message Details</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['full_name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['message_details']) . "</td>
                                    <td>" . htmlspecialchars($row['created_at']) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No messages found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Form to redirect to admin dashboard -->
    <form action="admin_dashboard.html" method="get">
        <button type="submit" class="btn"> Go to Admin Dashboard</button>
    </form>

</body>

</html>

<?php
$conn->close();
?>
