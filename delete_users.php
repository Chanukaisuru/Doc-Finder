<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Patient</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/delete_patient.css">
</head>
<body>
<div class="headers">
    <a href="#" class="logo">
        <div class="lo">
            <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
        </div> DOC FINDER
    </a>
</div>

<!-- Form to enter NIC -->
<div class="wrapper">
    <div>
        <form method="post" action="delete_users.php">
            <label for="nic">Patient NIC:</label>
            <input type="text" id="nic" name="nic" required>
            <input type="submit" value="Search">
        </form>
    </div>

    <?php
    // Include the database connection file
    include 'database.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $nic = $_POST['nic'];

        // Validate form data
        if (empty($nic)) {
            echo 'Please provide the patient\'s NIC.';
        } else {
            // Check if the delete request is made
            if (isset($_POST['delete'])) {
                // Prepare the delete statement
                $sql = "DELETE FROM patients WHERE nic = ?";
                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    die('Prepare failed: ' . $conn->error);
                }

                $stmt->bind_param("s", $nic);

                if ($stmt->execute()) {
                    // Check if any row was affected
                    if ($stmt->affected_rows > 0) {
                        // Redirect to the admin dashboard with a success message
                        header("Location: admin_dashboard.html");
                        exit();
                    } else {
                        echo "<p>No patient found with that NIC.</p>";
                    }
                } else {
                    echo 'Error: ' . $stmt->error;
                }

                // Close the statement and connection
                $stmt->close();
            } else {
                // Prepare the select statement
                $sql = "SELECT nic, first_name, last_name, age, phone_no, address, province, sick FROM patients WHERE nic = ?";
                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    die('Prepare failed: ' . $conn->error);
                }

                $stmt->bind_param("s", $nic);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();

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
                        <p><strong>Province:</strong> <?php echo htmlspecialchars($patient['province']); ?></p>
                        <p><strong>Sick:</strong> <?php echo htmlspecialchars($patient['sick']); ?></p>

                        <!-- Form to delete the patient -->
                        <form method="post" action="">
                            <input type="hidden" name="nic" value="<?php echo htmlspecialchars($patient['nic']); ?>">
                            <input type="submit" name="delete" value="Delete Patient">
                        </form>
                        <?php
                    } else {
                        echo 'No patient found with that NIC.';
                    }
                } else {
                    echo 'Error: ' . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            }

            // Close the connection
            $conn->close();
        }
    }
    ?>
</div>
</body>
</html>
