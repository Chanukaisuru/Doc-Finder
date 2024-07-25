<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Doctor</title>
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
        </div> DOC FINDER
    </a>

    <div class="auth-buttons">
        <a href="home.html" class="btn">Home</a>
        <a href="admin_dashboard.html" class="btn">Admin dashboard</a>
    </div>
</div>

<!-- Form to enter Email and Registration Number -->
<div>
    <div class="wrapper">
        <h1>Delete Doctor</h1>
        <!-- Message Box for Error and Success Messages -->
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
            <input type="submit" class="btn" name="search" value="Search">
        </form>
    </div>

    <?php
    // PHP code for handling form submission and deletion logic goes here
    ?>
</div>
</body>
</html>
