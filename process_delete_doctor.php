<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete us</title>
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
 
    <!-- Form to enter registration number -->
     <div class="wrapper">
        <div>
          <form method="post" action="process_delete_doctor.php">
          <label for="reg_no">Doctor Registration Number:</label>
          <input type="text" id="reg_no" name="reg_no" required>
          <input type="submit" value="Search">
    </form>
        </div>

    <?php
    // Include the database connection file
    include 'database.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $reg_no = $_POST['reg_no'];

        // Validate form data
        if (empty($reg_no)) {
            echo 'Please provide the doctor\'s registration number.';
        } else {
            // Check if the delete request is made
            if (isset($_POST['delete'])) {
                // Prepare the delete statement
                $sql = "DELETE FROM doctors WHERE reg_no = ?";
                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    die('Prepare failed: ' . $conn->error);
                }

                $stmt->bind_param("s", $reg_no);

                if ($stmt->execute()) {
                    // Check if any row was affected
                    if ($stmt->affected_rows > 0) {
                        // Redirect to the admin dashboard with a success message
                        header("Location:admin_dashboard.html");
                        exit();
                    } else {
                        echo "<p>No doctor found with that registration number.</p>";
                    }
                } else {
                    echo 'Error: ' . $stmt->error;
                }

                // Close the statement and connection
                $stmt->close();
            } else {
                // Prepare the select statement
                $sql = "SELECT reg_no, first_name, last_name, phone_no, province, qualification, specialty FROM doctors WHERE reg_no = ?";
                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    die('Prepare failed: ' . $conn->error);
                }

                $stmt->bind_param("s", $reg_no);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();

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

                        <!-- Form to delete the doctor -->
                        <form method="post" action="">
                            <input type="hidden" name="reg_no" value="<?php echo htmlspecialchars($doctor['reg_no']); ?>">
                            <input type="submit" name="delete" value="Delete Doctor">
                        </form>
                        <?php
                    } else {
                        echo 'No doctor found with that registration number.';
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
</body>
</html>
