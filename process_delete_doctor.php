<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Doctor</title>
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

<!-- Form to enter Email and Registration Number -->
<div>
    <div class="wrapper">
        <h1>Delete Doctor</h1>
        <form method="post" action="">
            <div class="input-box">
                <label for="email">User Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-box">
                <label for="reg_no">Doctor Registration Number:</label>
                <input type="text" id="reg_no" name="reg_no" required>
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
        $reg_no = $_POST['reg_no'];

        // Validate form data
        if (empty($email) || empty($reg_no)) {
            echo 'Please provide both the user\'s email and doctor\'s registration number.';
        } else {
            // Prepare the select statement for the doctors table
            $sql_doctors = "SELECT reg_no, first_name, last_name, phone_no, province, qualification, specialty FROM doctors WHERE reg_no = ?";
            $stmt_doctors = $conn->prepare($sql_doctors);

            if (!$stmt_doctors) {
                die('Prepare failed: ' . $conn->error);
            }

            $stmt_doctors->bind_param("s", $reg_no);

            if ($stmt_doctors->execute()) {
                $result = $stmt_doctors->get_result();

                if ($result->num_rows > 0) {
                    // Fetch and display the doctor's details
                    $doctor = $result->fetch_assoc();
                    ?>
                    <h2>Doctor Details</h2>
                    <p><strong>Registration Number:</strong> <?php echo htmlspecialchars($doctor['reg_no']); ?></p>
                    <p><strong>First Name:</strong> <?php echo htmlspecialchars($doctor['first_name']); ?></p>
                    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($doctor['last_name']); ?></p>
                    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($doctor['phone_no']); ?></p>
                    <p><strong>Province:</strong> <?php echo htmlspecialchars($doctor['province']); ?></p>
                    <p><strong>Qualification:</strong> <?php echo htmlspecialchars($doctor['qualification']); ?></p>
                    <p><strong>Specialty:</strong> <?php echo htmlspecialchars($doctor['specialty']); ?></p>

                    <!-- Form to confirm deletion -->
                    <form method="post" action="">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        <input type="hidden" name="reg_no" value="<?php echo htmlspecialchars($reg_no); ?>">
                        <input type="submit" name="delete" value="Delete Doctor">
                    </form>
                    <?php
                } else {
                    echo 'No doctor found with that registration number.';
                }
            } else {
                echo 'Error: ' . $stmt_doctors->error;
            }

            // Close the statement
            $stmt_doctors->close();
        }
    }

    // Check if the form is submitted for deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        // Get form data
        $email = $_POST['email'];
        $reg_no = $_POST['reg_no'];

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Prepare the delete statement for the doctors table
            $sql_doctors = "DELETE FROM doctors WHERE reg_no = ?";
            $stmt_doctors = $conn->prepare($sql_doctors);

            if (!$stmt_doctors) {
                throw new Exception('Prepare failed: ' . $conn->error);
            }

            $stmt_doctors->bind_param("s", $reg_no);

            // Execute the statement and check if any row was affected
            if ($stmt_doctors->execute() && $stmt_doctors->affected_rows > 0) {
                // Prepare the delete statement for the users table
                $sql_users = "DELETE FROM users WHERE email = ?";
                $stmt_users = $conn->prepare($sql_users);

                if (!$stmt_users) {
                    throw new Exception('Prepare failed: ' . $conn->error);
                }

                $stmt_users->bind_param("s", $email);

                // Execute the statement and check if any row was affected
                if ($stmt_users->execute() && $stmt_users->affected_rows > 0) {
                    // Commit the transaction
                    $conn->commit();
                    // Redirect to the admin dashboard with a success message
                    header("Location: admin_dashboard.html");
                    exit();
                } else {
                    throw new Exception('No user found with that email.');
                }
            } else {
                throw new Exception('No doctor found with that registration number.');
            }
        } catch (Exception $e) {
            // Rollback the transaction if an error occurred
            $conn->rollback();
            echo 'Error: ' . $e->getMessage();
        }

        // Close the statements and connection
        if (isset($stmt_users)) {
            $stmt_users->close();
        }
        if (isset($stmt_doctors)) {
            $stmt_doctors->close();
        }
        $conn->close();
    }
    ?>
</div>
</body>
</html>
