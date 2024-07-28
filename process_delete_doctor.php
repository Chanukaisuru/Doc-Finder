<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Doctor</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/delete_doctor.css">
    <style>
        .message-box {
            text-align: center; 
            font-size: 18px;    
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
            let regNo = document.getElementById('reg_no').value;
            let errorMsg = '';

            if (email === '' || regNo === '') {
                errorMsg += 'Please provide both the user\'s email and doctor\'s registration number.\n';
            }

            if (errorMsg) {
                document.getElementById('message').innerHTML = errorMsg;
                document.getElementById('message').classList.add('error');
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

    <div class="auth-buttons">
        <a href="home.html" class="btn">Home</a>
        <a href="admin_dashboard.html" class="btn">Admin dashboard</a>
    </div>
</div>


<div>
    <div class="wrapper">
        <h1>Delete Doctor</h1>
        
        <div class="message-box">
            <p id="message"></p>
        </div>

        <form method="post" action="" onsubmit="return validateForm()">
            <div class="input-box">
                <label for="email">Doctor's Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-box">
                <label for="reg_no">Doctor Registration Number:</label>
                <input type="text" id="reg_no" name="reg_no" required>
            </div>
            <br>
            <input type="submit" class="btn" name="search" value="Search">
        </form>
    </div>

    <?php
    //  database connection file
    include 'database.php';

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        // Get data
        $email = $_POST['email'];
        $reg_no = $_POST['reg_no'];

        // Prepare the select statement for the doctors table
        $sql_doctors = "SELECT reg_no, user_id, name, phone_no, district, location, qualification, specialty, profile_photo, hospital, address FROM doctors WHERE reg_no = ?";
        $stmt_doctors = $conn->prepare($sql_doctors);

        if (!$stmt_doctors) {
            echo '<script>document.getElementById("message").innerHTML = "Prepare failed: ' . $conn->error . '"; document.getElementById("message").classList.add("error");</script>';
        } else {
            $stmt_doctors->bind_param("s", $reg_no);

            if ($stmt_doctors->execute()) {
                $result = $stmt_doctors->get_result();

                if ($result->num_rows > 0) {
                    // Fetch display the doctor's details
                    $doctor = $result->fetch_assoc();
                    ?>
                    <div class="wrapper1">
                        <h2>Doctor Details</h2>
                        <p><strong>Registration Number:</strong> <?php echo htmlspecialchars($doctor['reg_no']); ?></p>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($doctor['name']); ?></p>
                        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($doctor['phone_no']); ?></p>
                        <p><strong>District:</strong> <?php echo htmlspecialchars($doctor['district']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($doctor['location']); ?></p>
                        <p><strong>Qualification:</strong> <?php echo htmlspecialchars($doctor['qualification']); ?></p>
                        <p><strong>Specialty:</strong> <?php echo htmlspecialchars($doctor['specialty']); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($doctor['address']); ?></p>

                        <?php if (!empty($doctor['profile_photo'])): ?>
                            <p><strong>Profile Photo:</strong></p>
                            <img src="<?php echo htmlspecialchars($doctor['profile_photo']); ?>" alt="Profile Photo" style="width: 150px; height: auto;">
                        <?php else: ?>
                            <p><strong>Profile Photo:</strong> No photo available.</p>
                        <?php endif; ?>

                        <!-- Form to confirm deletion -->
                        <form method="post" action="">
                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                            <input type="hidden" name="reg_no" value="<?php echo htmlspecialchars($reg_no); ?>">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($doctor['user_id']); ?>">
                            <input type="submit" name="delete" value="Delete Doctor">
                        </form>
                    </div>
                    <?php
                } else {
                    echo '<script>document.getElementById("message").innerHTML = "No doctor found with that registration number."; document.getElementById("message").classList.add("error");</script>';
                }
            } else {
                echo '<script>document.getElementById("message").innerHTML = "Error: ' . $stmt_doctors->error . '"; document.getElementById("message").classList.add("error");</script>';
            }

            
            $stmt_doctors->close(); //Close the statement
        }
    }

    // Check if the form is submitted for deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        
        $email = $_POST['email'];
        $reg_no = $_POST['reg_no'];
        $user_id = $_POST['user_id'];

        
        $conn->begin_transaction();

        try {
            
            $sql_doctors = "DELETE FROM doctors WHERE reg_no = ?";
            $stmt_doctors = $conn->prepare($sql_doctors);

            if (!$stmt_doctors) {
                throw new Exception('Prepare failed: ' . $conn->error);
            }

            $stmt_doctors->bind_param("s", $reg_no);

            
            if ($stmt_doctors->execute() && $stmt_doctors->affected_rows > 0) {
                // Prepare the delete statement for the users table
                $sql_users = "DELETE FROM users WHERE user_id = ?";
                $stmt_users = $conn->prepare($sql_users);

                if (!$stmt_users) {
                    throw new Exception('Prepare failed: ' . $conn->error);
                }

                $stmt_users->bind_param("i", $user_id);

                // Execute the statement and check if any row was affected
                if ($stmt_users->execute() && $stmt_users->affected_rows > 0) {
                    // Commit the transaction
                    $conn->commit();
                    
                    header("Location: admin_dashboard.html");
                    exit();
                } else {
                    throw new Exception('No user found with that user ID.');
                }
            } else {
                throw new Exception('No doctor found with that registration number.');
            }
        } catch (Exception $e) {
            
            $conn->rollback();
            echo '<script>document.getElementById("message").innerHTML = "Error: ' . $e->getMessage() . '"; document.getElementById("message").classList.add("error");</script>';
        }

        // Close statements and connection
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
