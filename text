<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include the database connection file
    $mysqli = require __DIR__ . "/database.php";

    // Sanitize and prepare the SQL query
    $sql = sprintf(
        "SELECT * FROM user WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );

    // Execute the query
    $result = $mysqli->query($sql);

    // Fetch the user data
    if ($result) {
        $user = $result->fetch_assoc();
    } else {
        die("Error: " . $mysqli->error);
    }

    // Verify the password
    if ($user && password_verify($_POST["password"], $user["password_hash"])) {
       
            session_regenerate_id();
            session_start();

            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;

    } else {
        $is_invalid = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Login</h1>

    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>

    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button>Log in</button>
    </form>    
</body>
</html>
