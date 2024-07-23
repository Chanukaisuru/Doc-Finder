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

    <div class="auth-buttons">
                <a href="home.html" class="btn">Home</a>
                <a href="admin_dashboard.html" class="btn">Admin dashboard</a>
    </div>

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
            <br>
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
                        <div class="input-box1">
                            <label for="password"><span style="font-size:16px; color:black; font-weight: bold;">Admin's Password:</span></label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <input type="submit" name="delete" value="Delete Admin" class="delete-btn">
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
        $password = $_POST['password'];

        // Prepare the select statement to get the hashed password
        $sql_password = "SELECT password FROM users WHERE email = ? AND role_no = 1";
        $stmt_password = $conn->prepare($sql_password);

        if (!$stmt_password) {
            die('Prepare failed: ' . $conn->error);
        }

        $stmt_password->bind_param("s", $email);

        if ($stmt_password->execute()) {
            $result = $stmt_password->get_result();

            if ($result->num_rows > 0) {
                $admin = $result->fetch_assoc();
                $hashed_password = $admin['password'];

                // Verify the password
                if (password_verify($password, $hashed_password)) {
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
                } else {
                    echo 'Incorrect password.';
                }
            } else {
                echo 'No admin found with that email.';
            }
        } else {
            echo 'Error: ' . $stmt_password->error;
        }

        // Close the statement and connection
        $stmt_password->close();
        $conn->close();
    }
    ?>
</div>
</body>
</html>
