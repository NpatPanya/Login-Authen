<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kpx";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handling registration
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['pin'])) {
    $regUsername = $_POST['username'];
    $regPassword = $_POST['password'];
    $regPin = $_POST['pin'];

    // Check if the username or PIN already exists
    $checkQuery = "SELECT * FROM users WHERE username='$regUsername' OR pin='$regPin'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Username or PIN already exists.";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (username, password, pin) VALUES ('$regUsername', '$regPassword', '$regPin')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
