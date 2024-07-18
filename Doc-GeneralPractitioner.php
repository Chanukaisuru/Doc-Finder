
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Doctors</title>
    <link rel="stylesheet" href="resources/css/select_doctor.css?v=1.0"> <!-- Added cache busting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="district_filter">
                <h3>Select Your District</h3>
                <div id="btns"></div>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <p>General Practitioner</p>
            </div>
            <div id="root">
                <?php
                // Include the database connection file
                include 'db_connection.php';

                // Query to fetch General Practitioner doctors
                $sql = "SELECT * FROM doctors WHERE specialty = 'General Practitioner'";
                $result = $conn->query($sql);

                // Check if any doctors found
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='doctor-card'>";
                        echo "<img src='uploads/" . $row['profile_photo'] . "' alt='Profile Photo'>";
                        echo "<h3>" . $row['name'] . "</h3>";
                        echo "<p><strong>Hospital:</strong> " . $row['hospital'] . "</p>";
                        echo "<p><strong>District:</strong> " . $row['district'] . "</p>";
                        echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
                        echo "<p><strong>Qualification:</strong> " . $row['qualification'] . "</p>";
                        echo "<p><strong>Phone:</strong> " . $row['phone_no'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No General Practitioner doctors found.</p>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script src="resources/js/select_doctor.js?v=1.0"></script> <!-- Added cache busting -->
</body>
</html>
