<?php
session_start();
include 'database.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $reg_no = $_POST['reg_no'];
    $name = $_POST['name'];
    $phone_no = $_POST['phone_no'];
    $district = $_POST['district'];
    $hospital = $_POST['hospital'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $qualification = $_POST['qualification'];
    $specialty = $_POST['specialty'];
    $profile_photo = $_FILES['profile_photo']['name'];

    
    $targetDir = "uploads/";
    $targetFilePath = $targetDir . basename($profile_photo);
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFilePath)){
            $uploadStatus = 1;
        } else {
            $uploadStatus = 0;
            $_SESSION['error_message'] = 'Sorry, there was an error uploading your file.'; //display error message
        }
    } else {
        $uploadStatus = 0;
        $_SESSION['error_message'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed.'; //display error message
    }

    if($uploadStatus == 1){
        // Check if reg_no already exists
        $sql = "SELECT reg_no FROM doctors WHERE reg_no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $reg_no);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            // reg_no already exists
            $_SESSION['error_message'] = 'Registration number already exists.';
        } else {
            // Insert new user record
            $sql = "INSERT INTO users (email, user_name, password, role_no) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $defaultPassword = ''; 
            $role_no = 2; 
            $stmt->bind_param("sssi", $email, $name, $defaultPassword, $role_no);

            if($stmt->execute()){
                $user_id = $stmt->insert_id; 

                // Insert new doctor record
                $sql = "INSERT INTO doctors (reg_no, user_id, name, phone_no, district, location, qualification, specialty, profile_photo, hospital, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sisssssssss", $reg_no, $user_id, $name, $phone_no, $district, $location, $qualification, $specialty, $profile_photo, $hospital, $address);

                if($stmt->execute()){
                    $_SESSION['success_message'] = 'Doctor registered successfully!';
                } else {
                    $_SESSION['error_message'] = 'Error: Could not register doctor.';
                }
            } else {
                $_SESSION['error_message'] = 'Error: Could not register user.';
            }
        }

        $stmt->close();
    }
    $conn->close();
    header('Location: register_doctor.php');
    exit();
}
?>
