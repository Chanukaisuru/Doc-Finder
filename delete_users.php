<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete User and Patient</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/delete_users.css">
</head>
<body>
<div class="headers">
    <a href="#" class="logo">
        <div class="lo">
            <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
        </div> DOC FINDER
    </a>
</div>

<!-- Form to enter Email and NIC -->
<div>
    <div class="wrapper">
        <h1>Delete User</h1>
        <form method="post" action="">
            <div class="input-box">
                <label for="email">User Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-box">
                <label for="nic">Patient NIC:</label>
                <input type="text" id="nic" name="nic" required>
            </div><br>
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
        $nic = $_POST['nic'];

        // Validate form data
        if (empty($email) || empty($nic)) {
            echo 'Please provide both the user\'s email and patient\'s NIC.';
        } else {
            // Prepare the select statement for the patients table
            $sql_patients = "SELECT nic, first_name, last_name, age, phone_no, address, district, sick FROM patients WHERE nic = ?";
            $stmt_patients = $conn->prepare($sql_patients);

            if (!$stmt_patients) {
                die('Prepare failed: ' . $conn->error);
            }

            $stmt_patients->bind_param("s", $nic);

            if ($stmt_patients->execute()) {
                $result = $stmt_patients->get_result();

                if ($result->num_rows > 0) {
                    // Fetch and display the patient's details
                    $patient = $result->fetch_assoc();
                    ?>
                    <h2>Patient Details</h2>
                    <p><strong>NIC:</strong> <?php echo htmlspecialchars($patient['nic']); ?></p>
                    <p><strong>First Name:</strong> <?php echo htmlspecialchars($patient['first_name']); ?></p>
                    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($patient['last_name']); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($patient['age']); ?></p>
                    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($patient['phone_no']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($patient['address']); ?></p>
                    <p><strong>District:</strong> <?php echo htmlspecialchars($patient['district']); ?></p>
                    <p><strong>Sick:</strong> <?php echo htmlspecialchars($patient['sick']); ?></p>

                    <!-- Form to confirm deletion -->
                    <form method="post" action="">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        <input type="hidden" name="nic" value="<?php echo htmlspecialchars($nic); ?>">
                        <input type="submit" name="delete" value="Delete Patient">
                    </form>
                    <?php
                } else {
                    echo 'No patient found with that NIC.';
                }
            } else {
                echo 'Error: ' . $stmt_patients->error;
            }

            // Close the statement
            $stmt_patients->close();
        }
    }

    // Check if the form is submitted for deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        // Get form data
        $email = $_POST['email'];
        $nic = $_POST['nic'];

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Prepare the delete statement for the patients table
            $sql_patients = "DELETE FROM patients WHERE nic = ?";
            $stmt_patients = $conn->prepare($sql_patients);

            if (!$stmt_patients) {
                throw new Exception('Prepare failed: ' . $conn->error);
            }

            $stmt_patients->bind_param("s", $nic);

            // Execute the statement and check if any row was affected
            if ($stmt_patients->execute() && $stmt_patients->affected_rows > 0) {
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
                throw new Exception('No patient found with that NIC.');
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
        if (isset($stmt_patients)) {
            $stmt_patients->close();
        }
        $conn->close();
    }
    ?>
</div>
</body>
</html>
