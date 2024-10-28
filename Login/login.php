<?php
    include("auth.php")
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
                            <img width="250" height="250" src="/Storage/Login/images/user.png" alt="" style="padding: 50px;">
    
                            <form method="POST" action="">
                                <input type="text" name="username" class="form-control my-3 py-2" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
                                <span class="error"><?php echo $usernameErr;?></span>
                                
                                <input type="text" name="email" class="form-control my-3 py-2" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                                <span class="error"><?php echo $emailErr;?></span>
                                
                                <input type="password" name="password" class="form-control my-3 py-2" placeholder="Password">
                                <span class="error"><?php echo $passwordErr;?></span>
    
                                <div class="text-center mt-3" style="padding-top: 50px;">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>

                                <?php if (!empty($loginErr)): ?>
                                    <div class="text-danger mt-3"><?php echo $loginErr; ?></div>
                                <?php endif; ?>
    
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
