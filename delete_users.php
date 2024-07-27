<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete User and Patient</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/delete_users.css">
    <style>
        .message-box {
            text-align: center; 
            font-size: 16px;    
            margin: 20px 0;     
        }

        .message-box p {
            margin: 0;          
            padding: 10px;      
        }

        .message-box .error {
            color: red;         
        }

        .message-box .success {
            color: green;       
        }
    </style>
    <script>
        function validateForm() {
            let email = document.getElementById('email').value;
            let nic = document.getElementById('nic').value;
            let errorMsg = '';

            if (email === '' || nic === '') {
                errorMsg += 'Please provide both the user\'s email and patient\'s NIC.\n';
            }

            if (errorMsg) {
                let messageElement = document.getElementById('message');
                messageElement.innerText = errorMsg;
                messageElement.className = 'error';
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="headers">
        <a href="home.html" class="logo">
            <div class="lo">
                <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
            </div>
                <div class = "log"><p>DOC FINDER </p>
            </div>
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
            echo '<script>
                    let messageElement = document.getElementById("message");
                    messageElement.innerText = "Please provide both the user\'s email and patient\'s NIC.";
                    messageElement.className = "error";
                  </script>';
        } else {
            // Prepare the select statement for the patients table
            $sql_patients = "SELECT nic, first_name, last_name, age, phone_no, address, district, sick FROM patients WHERE nic = ?";
            $stmt_patients = $conn->prepare($sql_patients);

            if (!$stmt_patients) {
                echo '<script>
                        let messageElement = document.getElementById("message");
                        messageElement.innerText = "Prepare failed: ' . htmlspecialchars($conn->error) . '";
                        messageElement.className = "error";
                      </script>';
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
                    echo '<script>
                            let messageElement = document.getElementById("message");
                            messageElement.innerText = "No patient found with that NIC.";
                            messageElement.className = "error";
                          </script>';
                }
            } else {
                echo '<script>
                        let messageElement = document.getElementById("message");
                        messageElement.innerText = "Error: ' . htmlspecialchars($stmt_patients->error) . '";
                        messageElement.className = "error";
                      </script>';
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
                    echo '<script>
                            let messageElement = document.getElementById("message");
                            messageElement.innerText = "Patient and user deleted successfully.";
                            messageElement.className = "success";
                            setTimeout(() => {
                                window.location.href = "admin_dashboard.html";
                            }, 2000);
                          </script>';
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
            echo '<script>
                    let messageElement = document.getElementById("message");
                    messageElement.innerText = "Error: ' . htmlspecialchars($e->getMessage()) . '";
                    messageElement.className = "error";
                  </script>';
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
