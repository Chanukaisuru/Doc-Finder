<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
    <link rel="icon" href="resources/img/doc_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="resources/css/register_doctor.css">
    <style>
        .message-box .error {
            color: red;
        }
        .message-box .success {
            color: green;
        }
    </style>
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
    <div class="wrapper">
        <h1>Doctor Registration</h1>

        <!-- Display messages -->
        <div class="message-box">
            <?php
            // Start session
            session_start();

            // Display error message if any
            if (!empty($_SESSION['error_message'])) {
                echo "<p class='error'>{$_SESSION['error_message']}</p>";
                $_SESSION['error_message'] = ''; // Clear the message after displaying
            }

            // Display success message if any
            if (!empty($_SESSION['success_message'])) {
                echo "<p class='success'>{$_SESSION['success_message']}</p>";
                $_SESSION['success_message'] = ''; // Clear the message after displaying
            }
            ?>
        </div>

        <form action="process_register_doctor.php" method="post" enctype="multipart/form-data">
            <div class="input-box">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
            </div>
            <div class="input-box">
                <label for="reg_no">Registration Number:</label>
                <input type="text" id="reg_no" name="reg_no" required><br><br>
            </div>
            <div class="input-box">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
            </div>
            <div class="input-box">
                <label for="phone_no">Phone Number:</label>
                <input type="text" id="phone_no" name="phone_no" required><br><br>
            </div>
            <div class="input-box">
                <label for="district">District:</label>
                <select id="district" name="district" required>
                    <option value="">Select District</option>
                    <option value="Matara">Matara</option>
                    <option value="Gampaha">Gampaha</option>
                    <option value="Galle">Galle</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Hambantota">Hambantota</option>
                    <option value="Kalutara">Kalutara</option>
                </select><br><br>
            </div>
            <div class="input-box">
                <label for="hospital">Hospital:</label>
                <input type="text" id="hospital" name="hospital" required><br><br>
            </div>
            <div class="input-box">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br><br>
            </div>
            <div class="input-box">
                <label for="location">Location (Map):</label>
                <input type="text" id="location" name="location" required placeholder="Enter location link"><br><br>
            </div>
            <div class="input-box">
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="qualification" required><br><br>
            </div>
            <div class="input-box">
                <label for="specialty">Specialty:</label>
                <select id="specialty" name="specialty" required>
                    <option value="">Select Specialty</option>
                    <option value="General Practitioner">General Practitioner</option>
                    <option value="Dentist">Dentist</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="Gynecologist">Gynecologist</option>
                    <option value="Respiratory physician">Respiratory physician</option>
                    <option value="Orthopedic surgeon">Orthopedic surgeon</option>
                    <option value="Ophthalmologist">Ophthalmologist</option>
                    <option value="Nephrologists">Nephrologists</option>
                    <option value="Cardiologist">Cardiologist</option>
                </select><br><br>
            </div>
            <div class="input-box">
                <label for="profile_photo">Profile Photo:</label>
                <input type="file" id="profile_photo" name="profile_photo" required><br><br>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>
</html>
