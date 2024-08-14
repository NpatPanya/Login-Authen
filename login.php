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

// Handling login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $loginUsername = $_POST['username'];
        $loginPassword = $_POST['password'];

        // Check user credentials against the database
        $loginQuery = "SELECT * FROM users WHERE username='$loginUsername'";
        $result = mysqli_query($conn, $loginQuery);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            
            // Compare the passwords without password_verify (for debugging)
            if ($loginPassword === $hashedPassword) {
                echo "login successful Welcome!";
            } else {
                echo "Passwords don't match!";
            }
        } else {
            echo "Login failed. User not found.";
        }
    }
}

