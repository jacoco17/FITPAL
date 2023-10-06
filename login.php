<?php
// Start a session to store user information
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your database connection code goes here
    // Replace the following lines with your actual database connection code
    $servername = "your_server_name";
    $username = "your_db_username";
    $password = "your_db_password";
    $dbname = "your_db_name";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for database connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the input data from the form
    $uname = $_POST["uname"];
    $password = $_POST["password"];

    // Perform SQL query to check user credentials
    $sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User authentication successful
        $_SESSION["username"] = $uname;
        header("location: welcome.php"); // Redirect to a welcome page
    } else {
        // User authentication failed
        header("location: login.php?error=Invalid username or password");
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file here -->
</head>
<body>
<div class="form">
    <div class="login">
        <form action="login.php" method="post">
            <h2>LOGIN</h2>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php } ?>

            <input type="text" name="uname" id="uname" placeholder="Username" required><br><br>

            <input type="password" name="password" id="password" placeholder="Password" required><br>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</div>
</body>
</html>
