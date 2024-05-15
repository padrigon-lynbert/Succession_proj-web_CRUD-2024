<?php //user.php
    include("connection.php");

    if (isset($_POST['submit']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $current_position = $_POST['current_position'];
        $promotion_to = $_POST['promotion_to'];

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO employee (fname, lname, current_position, promotion_to) VALUES (?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $current_position, $promotion_to);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result)
        {
            // echo "Data inserted";
            header('location:AdminPage.php');
        }
        else
        {
            die("Insertion failed: " . mysqli_error($connection));
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Storage/Boostrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Storage/Dashboard/CSS/style.css">
    <title>User</title>
</head>
<body>


<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/Storage/Dashboard/Images/s-w.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Leaders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Admin-Dashboard.php">Dashboard</a>
                    </li>
                </ul>
                <a href="/Storage/Login/login.php" class="btn btn-brand ms-lg-3">Download</a>
            </div>
        </div>
    </nav>


        
    <section>
        <div class="container my-5">
            <form method="POST">
                <div class="mb-3">
                    <label>First name</label>
                    <input type="text" class="form-control", placeholder="-", name="fname", autocomplete="off">
                </div>
                <div class="mb-3">
                    <label>Lastname</label>
                    <input type="text" class="form-control", placeholder="-", name="lname", autocomplete="off">
                </div>
                <div class="mb-3">
                    <label>Current position</label>
                    <input type="text" class="form-control", placeholder="-", name="current_position", autocomplete="off">
                </div>
                <div class="mb-3">
                    <label>Promotion to</label>
                    <input type="text" class="form-control", placeholder="-", name="promotion_to", autocomplete="off">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>


    </section>





    <script src="/Storage/Boostrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>




<!-- FOOTER -->
<footer class="bg-dark">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-3 col-sm-6">
                    <a href="#"><img src="/Storage/Dashboard/Images/s-w.png" alt=""></a>
                    <div class="line"></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, hic!</p>
                    <div class="social-icons">
                        <a href="#"><i class="ri-twitter-fill"><img class="icon-img3" src="/Storage/Dashboard/Images/footer/github.svg" alt=""></i></a>
                        <a href="#"><i class="ri-twitter-fill"><img class="icon-img3" src="/Storage/Dashboard/Images/footer/facebook.svg" alt=""></i></a>
                        <a href="#"><i class="ri-twitter-fill"><img class="icon-img3" src="/Storage/Dashboard/Images/footer/instagram.svg" alt=""></i></a>
                        <a href="#"><i class="ri-twitter-fill"><img class="icon-img3" src="/Storage/Dashboard/Images/footer/info-circle.svg" alt=""></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h5 class="mb-0 text-white">SERVICES</h5>
                    <div class="line"></div>
                    <ul>
                        <li><a href="#">Machine Learning</a></li>
                        <li><a href="#">UI UX Destroyer</a></li>
                        <li><a href="#">Briefs Model</a></li>
                        <li><a href="#">Clown</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h5 class="mb-0 text-white">ABOUT</h5>
                    <div class="line"></div>
                    <ul>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Career</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h5 class="mb-0 text-white">CONTACT</h5>
                    <div class="line"></div>
                    <ul>
                        <li>New York, NY 3300</li>
                        <li>(414) 586 - 3017</li>
                        <li>padirigonlynbert@services.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-auto">
                    <p class="mb-0">© Copyright Succession | All Rights Reserved.</p>
                </div>
                <div class="col-auto">
                    <p class="mb-0"> By <a href="https://">Padrigon, L.S. Orilla</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>


