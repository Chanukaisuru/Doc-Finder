<?php
include 'database.php';

$reg_no = $_GET['reg_no'];
$sql = "
    SELECT d.*, u.email 
    FROM doctors d 
    JOIN users u ON d.user_id = u.user_id 
    WHERE d.reg_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $reg_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $doctor = $result->fetch_assoc();
} else {
    echo "No doctor found";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/Doc.information.css">
    <title>Doctor Information</title>
</head>
<body>
    <div class="main">
        <div class="top-section">
            <img src="uploads/<?php echo $doctor['profile_photo']; ?>" class="profile">
            <p class="p1"><?php echo $doctor['name']; ?></p>
            <p class="p2"><?php echo $doctor['specialty']; ?></p>
        </div>

        <div class="clearfix"></div>

        <div class="col-div-4">
            <div class="content-box" style="padding-left: 40px;">
                <p class="head">Contact</p>
                <p class="p3"><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;<?php echo $doctor['phone_no']; ?></p>
                <p class="p3"><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;<?php echo $doctor['email']; ?></p>
                <p class="p3"><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;<?php echo $doctor['address']; ?></p>

                <br/><br/>

                <p class="head">Location</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3588.8168723083672!2d80.9466382744793!3d6.293701125792175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae6a8516f9211e9%3A0xd5be240343b8b956!2sHathporuwa%20Sri%20bodirukkaramaya!5e1!3m2!1sen!2slk!4v1721971327915!5m2!1sen!2slk" width="250" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"><?php echo urlencode($doctor['location']); ?></iframe>
                
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3588.8168723083672!2d80.9466382744793!3d6.293701125792175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae6a8516f9211e9%3A0xd5be240343b8b956!2sHathporuwa%20Sri%20bodirukkaramaya!5e1!3m2!1sen!2slk!4v1721971327915!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"><?php echo urlencode($doctor['location']); ?></iframe>
            </div>
        </div>   
        
        <div class="line"></div>

        <div class="col-div-8">
            <div class="content-box">
                <p class="head">Ordination times</p>
                <ul class="day-list">
                    <li class="day"><span>Monday</span><span>11.00 am - 2.00 pm</span></li>
                    <li class="day"><span>Tuesday</span><span>11.00 am - 2.00 pm</span></li>
                    <li class="day"><span>Wednesday</span><span>11.00 am - 2.00 pm</span></li>
                    <li class="day"><span>Thursday</span><span>11.00 am - 2.00 pm</span></li>
                    <li class="day"><span>Friday</span><span>11.00 am - 2.00 pm</span></li>
                    <li class="day"><span>Saturday</span><span>11.00 am - 2.00 pm</span></li>
                    <li class="day"><span>Sunday</span><span>11.00 am - 2.00 pm</span></li>
                </ul>

                <br/>

                <p class="head">Training and Additional Fields</p>
                <p><?php echo $doctor['qualification']; ?></p>

                <br/>
                <p class="head">Spoken languages</p>
                <ul>
                    <li>English</li>
                    <li>Sinhala</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
