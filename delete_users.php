<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete User and Patient</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/delete_users.css">
    <script>
        function validateForm() {
            let email = document.getElementById('email').value;
            let nic = document.getElementById('nic').value;
            let errorMsg = '';

            if (email === '' || nic === '') {
                errorMsg += 'Please provide both the user\'s email and patient\'s NIC.\n';
            }

            if (errorMsg) {
                document.getElementById('message').innerText = errorMsg;
                document.getElementById('message').style.color = 'red';
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="headers">
    <a href="#" class="logo">
        <div class="lo">
            <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
        </div> DOC FINDER
    </a>
</div>

<div>
    <div class="wrapper">
        <h1>Delete User</h1>
        <!-- Message Box for Error and Success Messages -->
    <div class="message-box">
        <p id="message"></p>
    </div>
        <form method="post" action="" onsubmit="return validateForm()">
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

    <!-- Message Box for Error and Success Messages -->
    <div class="message-box">
        <p id="message"></p>
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
            echo '<script>document.getElementById("message").innerText = "Please provide both the user\'s email and patient\'s NIC.";</script>';
            echo '<script>document.getElementById("message").style.color = "red";</script>';
        } else {
            // Prepare the select statement for the patients table
            $sql_patients = "SELECT nic, first_name, last_name, age, phone_no, address, district, sick FROM patients WHERE nic = ?";
            $stmt_patients = $conn->prepare($sql_patients);

            if (!$stmt_patients) {
                echo '<script>document.getElementById("message").innerText = "Prepare failed: ' . htmlspecialchars($conn->error) . '";</script>';
                echo '<script>document.getElementById("message").style.color = "red";</script>';
                die();
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
                    echo '<script>document.getElementById("message").innerText = "No patient found with that NIC.";</script>';
                    echo '<script>document.getElementById("message").style.color = "red";</script>';
                }
            } else {
                echo '<script>document.getElementById("message").innerText = "Error: ' . htmlspecialchars($stmt_patients->error) . '";</script>';
                echo '<script>document.getElementById("message").style.color = "red";</script>';
            }

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
            echo '<script>document.getElementById("message").innerText = "Error: ' . htmlspecialchars($e->getMessage()) . '";</script>';
            echo '<script>document.getElementById("message").style.color = "red";</script>';
        }

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
