<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/delete_doctor.css">
</head>
<body>
<div class="headers">
    <a href="#" class="logo">
        <div class="lo">
            <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
        </div> DOC FINDER
    </a>
</div>

<!-- Form to enter Admin Email -->
<div>
    <div class="wrapper">
        <h1>Delete Admin</h1>
        <form method="post" action="">
            <div class="input-box">
                <label for="email">Admin's Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <input type="submit" class="btn" name="search" value="Search">
        </form>
    </div>

    <?php
    // Include the database connection file
    include 'database.php';

    // Check if the form is submitted for search
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        // Get form data
        $email = $_POST['email'];

        // Validate form data
        if (empty($email)) {
            echo 'Please provide the admin\'s email.';
        } else {
            // Prepare the select statement for the users table
            $sql_admin = "SELECT user_name, email, created_at FROM users WHERE email = ? AND role_no = 1";
            $stmt_admin = $conn->prepare($sql_admin);

            if (!$stmt_admin) {
                die('Prepare failed: ' . $conn->error);
            }

            $stmt_admin->bind_param("s", $email);

            if ($stmt_admin->execute()) {
                $result = $stmt_admin->get_result();

                if ($result->num_rows > 0) {
                    // Fetch and display the admin's details
                    $admin = $result->fetch_assoc();
                    ?>
                    <div class="sr">
                    <h2>Admin Details</h2>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($admin['user_name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
                    <p><strong>Created At:</strong> <?php echo htmlspecialchars($admin['created_at']); ?></p>
                    </div>

                    <!-- Form to confirm deletion -->
                    <form method="post" action="">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        <input type="submit" name="delete" value="Delete Admin">
                    </form>
                    <?php
                } else {
                    echo 'No admin found with that email.';
                }
            } else {
                echo 'Error: ' . $stmt_admin->error;
            }

            // Close the statement
            $stmt_admin->close();
        }
    }

    // Check if the form is submitted for deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        // Get form data
        $email = $_POST['email'];

        // Prepare the delete statement for the users table
        $sql_admin = "DELETE FROM users WHERE email = ? AND role_no = 1";
        $stmt_admin = $conn->prepare($sql_admin);

        if (!$stmt_admin) {
            die('Prepare failed: ' . $conn->error);
        }

        $stmt_admin->bind_param("s", $email);

        // Execute the statement and check if any row was affected
        if ($stmt_admin->execute() && $stmt_admin->affected_rows > 0) {
            // Redirect to the admin dashboard with a success message
            header("Location: admin_dashboard.html");
            exit();
        } else {
            echo 'No admin found with that email.';
        }

        // Close the statement and connection
        $stmt_admin->close();
        $conn->close();
    }
    ?>
</div>
</body>
</html>
