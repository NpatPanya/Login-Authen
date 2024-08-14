<?php
// Database connection (update with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kpx";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['pin']) && isset($_POST['new_password'])) {
        $username = $_POST['username'];
        $pin = $_POST['pin'];
        $newPassword = $_POST['new_password'];

        // Verify PIN
        $pinQuery = "SELECT * FROM users WHERE username='$username' AND pin='$pin'";
        $result = mysqli_query($conn, $pinQuery);

        if (mysqli_num_rows($result) == 1) {
            // PIN matches, update the password in the database (without hashing)
            $updateQuery = "UPDATE users SET password='$newPassword' WHERE username='$username'";
            
            if (mysqli_query($conn, $updateQuery)) {
                echo "Password reset successful!";
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "PIN verification failed. Please check your PIN.";
        }
    }
}

mysqli_close($conn);
?>
