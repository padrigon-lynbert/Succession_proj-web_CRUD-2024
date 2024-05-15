<?php
include("connections.php");

$Email = $password = "";
$EmailErr = $passwordErr = "";

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty($_POST["email"])) {
        $EmailErr = "Email is required";
    } else {
        $Email = $_POST["email"];
    }
    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    // If there are no validation errors
    if (empty($EmailErr) && empty($passwordErr)) {
        // Query to validate user
        $sql = "SELECT * FROM login_table WHERE username='$Email' AND password='$password'";
        $result = mysqli_query($connection, $sql);

        // Check if a matching record is found
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Check if the user is admin or user
            if ($row['username'] === 'admin') {
                // Redirect to admin page
                header("Location: /Storage/Admin/PHP/Admin-Dashboard.php");
                exit(); // Ensure no further execution after redirection
            } elseif ($row['username'] === 'user') {
                // Redirect to user page
                header("Location: /Storage/Dashboard/PHP/Dashboard.php");
                exit(); // Ensure no further execution after redirection
            } else {
                echo "<br>Invalid username or password!";
            }
        } else {
            echo "<br>Invalid username or password!";
        }
    }
}

// Close the connection
mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Storage/Boostrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Storage/Login/css/style.css">

    <title>Login</title>
</head>
<body>
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 mx-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body text-center">
                            <png class="mx-auto my-3 px-2"><img width="250" height="250" src="/Storage/Login/images/user.png" alt="" style="padding: 50px;"></png>
    
                            <form method="POST" action="">
                                <input type="text" name="email" class="form-control my-3 py-2" placeholder="Email">
                                <span class="error"><?php echo $EmailErr;?></span>
                                <input type="password" name="password" class="form-control my-3 py-2" placeholder="Password">
                                <span class="error"><?php echo $passwordErr;?></span>
    
                                <div class="text-center mt-3" style="padding-top: 50px;">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
    
                                <div class="text-center mt-3">
                                    <a href="#" class="nav-link" style="padding: 5px;">Logging Errors?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <script src="/Storage/Boostrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
