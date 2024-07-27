<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Admin</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="resources/css/delete_doctor.css">

    <style>
        .error {
            color: #d8000c;
            font-size: 14px;
            margin-left:90px;
        }

        .success {
            color: #4f8a10;
            font-size: 14px;
            margin-left:90px;
        }
    </style>
</head>
<body>
<div class="headers">
    <a href="home.html" class="logo">
        <div class="lo">
            <img src="resources/img/doc_logo.png" style="width: 100px; height:65px">
        </div>
        <div class="log"><p>DOC FINDER</p></div>
    </a>
    <div class="auth-buttons">
        <a href="home.html" class="btn">Home</a>
        <a href="admin_dashboard.html" class="btn">Admin Dashboard</a>
    </div>
</div>

<div class="wrapper">
    <h1 style='color: black;'>Delete Admin</h1>
    <!-- Display messages -->
    <div class="message-box">
        <?php
        session_start();

        if (!empty($_SESSION['error_message'])) {
            echo "<p class='error'>{$_SESSION['error_message']}</p>";
            $_SESSION['error_message'] = ''; 
        }

        if (!empty($_SESSION['success_message'])) {
            echo "<p class='success'>{$_SESSION['success_message']}</p>";
            $_SESSION['success_message'] = ''; 
        }
        ?>
    </div>

    <form method="post">
        <div class="input-box">
            <label for="email">Admin's Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <br>
        <input type="submit" class="btn" name="search" value="Search">
    </form>
</div>

<?php

include 'database.php';

// Check if the form is submitted for search
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $_SESSION['error_message'] = 'Please provide the admin\'s email.';
        header("Location: delete_admin.php");
        exit();
    } else {
        $sql_admin = "SELECT user_name, email, created_at FROM users WHERE email = ? AND role_no = 1";
        $stmt_admin = $conn->prepare($sql_admin);

        if ($stmt_admin === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt_admin->bind_param("s", $email);
        $stmt_admin->execute();
        $result = $stmt_admin->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            ?>
            <div class="wrapper1">
                <h2>Admin Details</h2>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($admin['user_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
                <p><strong>Created At:</strong> <?php echo htmlspecialchars($admin['created_at']); ?></p>
                
                <form method="post" action="">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <div class="input-box1">
                        <label for="password"><span style="font-size:16px; color:black; font-weight: bold;">Admin's Password:</span></label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <br>
                    <input type="submit" name="delete" value="Delete Admin" class="delete-btn">
                </form>
            </div>
            <?php
        } else {

            $_SESSION['error_message'] = 'No admin found with that email.';
            header("Location: delete_admin.php");
            exit();
        }

        $stmt_admin->close();
    }
}

// form is submitted for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = 'Please fill in all fields.';
        header("Location: delete_admin.php");
        exit();
    }

    $sql_password = "SELECT password FROM users WHERE email = ? AND role_no = 1";
    $stmt_password = $conn->prepare($sql_password);

    if ($stmt_password === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt_password->bind_param("s", $email);
    $stmt_password->execute();
    $result = $stmt_password->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $hashed_password = $admin['password'];

        if (password_verify($password, $hashed_password)) {
            $sql_delete = "DELETE FROM users WHERE email = ? AND role_no = 1";
            $stmt_delete = $conn->prepare($sql_delete);

            if ($stmt_delete === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt_delete->bind_param("s", $email);
            if ($stmt_delete->execute() && $stmt_delete->affected_rows > 0) {
                $_SESSION['success_message'] = 'Admin deleted successfully.';
                header("Location: admin_dashboard.html");
                exit();
            } else {
                $_SESSION['error_message'] = 'Error deleting admin. Please try again.';
                header("Location: delete_admin.php");
                exit();
            }

            $stmt_delete->close();
        } else {
            $_SESSION['error_message'] = 'Incorrect password.';
            header("Location: delete_admin.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'No admin found with that email.';
        header("Location: delete_admin.php");
        exit();
    }

    $stmt_password->close();
}

$conn->close();
?>
</body>
</html>
