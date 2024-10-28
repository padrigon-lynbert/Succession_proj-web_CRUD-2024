<?php
// Start output buffering
ob_start(); 
include("../connections.php");

$username = $email = $password = "";
$usernameErr = $emailErr = $passwordErr = "";
$loginErr = "";
$loginSuccess = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = mysqli_real_escape_string($connection, $_POST["username"]);
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = mysqli_real_escape_string($connection, $_POST["email"]);
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = mysqli_real_escape_string($connection, $_POST["password"]);
    }

    // Check if all fields are filled
    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
        // Check for login in login_admin table
        $adminQuery = "SELECT * FROM login_admin WHERE username = '$username' AND email = '$email'";
        $adminResult = mysqli_query($connection, $adminQuery);

        // Check if user exists in admin table
        if (mysqli_num_rows($adminResult) > 0) {
            $row = mysqli_fetch_assoc($adminResult);
            // Verify password
            if ($row['password_hash'] === $password) {  // Use password_verify() if hashed
                $loginSuccess = true;
                // Redirect to Dashboard.php
                header("Location: /storage/Dashboard/PHP/Dashboard.php");
                exit(); // Stop further script execution
            } else {
                $loginErr = "Invalid password.";
            }
        } else {
            // Check for login in admindashboard
            $userQuery = "SELECT * FROM attendance.login_user WHERE username = '$username' AND email = '$email'";
            $userResult = mysqli_query($connection, $userQuery);

            // Check if user exists in user table
            if (mysqli_num_rows($userResult) > 0) {
                $row = mysqli_fetch_assoc($userResult);
                // Verify password
                if ($row['password_hash'] === $password) {  // Use password_verify() if hashed
                    $loginSuccess = true;
                    // Redirect to userdashboard
                    header("Location: /storage/Dashboard/PHP/Dashboard.php");
                    exit(); // Stop further script execution
                } else {
                    $loginErr = "Invalid password.";
                }
            } else {
                $loginErr = "No user found with that username and email.";
            }
        }
    }
}

mysqli_close($connection);
ob_end_flush(); // End output buffering
?>
