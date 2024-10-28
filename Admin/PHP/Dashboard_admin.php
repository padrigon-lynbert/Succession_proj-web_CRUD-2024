<?php
    include("auth_dashboard.php");    


    // Check if the form is submitted via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Iterate through each student's attendance and recitation input
        foreach ($_POST['recitation'] as $studentID => $recitationScore) {
            // Get the corresponding attendance status
            $attendanceStatus = $_POST['attendance'][$studentID];

            // Prepare the SQL query to update both recitation and attendance
            $sql = "UPDATE `student` SET `Recitation` = ?, `Attendance` = ? WHERE `studentID` = ?";

            // Use prepared statements for security
            if ($stmt = mysqli_prepare($connection, $sql)) {
                // Bind the parameters: "dsi" (double, string, integer)
                mysqli_stmt_bind_param($stmt, "dsi", $recitationScore, $attendanceStatus, $studentID);

                // Execute the query
                if (mysqli_stmt_execute($stmt)) {
                    echo "Updated student ID: " . $studentID . "<br>";
                } else {
                    echo "Error updating student ID: " . $studentID . "<br>";
                }

                // Close the prepared statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing the statement.<br>";
            }
        }

        // Close the database connection
        mysqli_close($connection);

        // Redirect back to the attendance page after updating
       header("Location: /Storage/Admin/PHP/Dashboard_admin.php");

        exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Storage/Dashboard/CSS/style.css">
    <link rel="stylesheet" href="/Storage/Boostrap/css/bootstrap.min.css">
    <title>Dashboard</title>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/Storage/Dashboard/Images/hero/The+Title.png" alt="" style="width: 150px; height: auto;">
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
                        <a class="nav-link" href="#attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Info</a>
                    </li>
                </ul>
                <a href="/Storage/Login/login.php" class="btn btn-brand ms-lg-3">Logout</a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="hero" class="min-vh-100 d-flex align-items-center text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 data-aos="fade-left" class="text-uppercase text-white fw-semibold display-1">appearance and participation</h1>
                    <h5 class="text-white mt-3 mb-4" data-aos="fade-right">TO HELP YOU RECORD ATTENDANCE AND PARTICIPATION FOR EACH CLASS</h5>
                    <div data-aos="fade-up" data-aos-delay="50">

                        <a href="#portfolio" class="btn btn-light ms-2" style="color: blueviolet;">Btn1</a>
                        <a href="#services" class="btn btn-dark ms-2" style="color: chartreuse;">Btn2</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- attendance table -->
    <section id="attendance" style="margin: 10px 10px;">

        <h1 style="margin: 100px;">Attendance Table</h1>

        <!-- Wrap the table in a form -->
        <form method="POST" action="/Storage/Admin/PHP/Dashboard_admin.php">
            <table class="table my-5" style="margin-left: 50px;">
                <thead>
                    <tr>
                        <th scope="col">Student #</th>
                        <th scope="col">Fname</th>
                        <th scope="col">Lname</th>
                        <th scope="col">Mname</th>
                        <th scope="col">Recitation</th>
                        <th scope="col">Attendance</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $sql = "SELECT * FROM `student`";
                        $result = mysqli_query($connection, $sql);

                        if($result) 
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $id = $row['studentID'];
                                $fname = $row['Firstname'];
                                $lname = $row['Lastname'];
                                $mname = $row['Middlename'];
                                $recitation = $row['Recitation'];
                                $attendance = $row['Attendance'];

                                echo '<tr>
                                    <th scope="row">'.$id.'</th>
                                    <td>'.$fname.'</td>
                                    <td>'.$lname.'</td>
                                    <td>'.$mname.'</td>
                                    <td>
                                        <input type="number" step="0.01" class="form-control" name="recitation['.$id.']" value="'.$recitation.'" />
                                    </td>
                                    <td>
                                        <select class="form-select" name="attendance['.$id.']">
                                            <option value="Present" '.($attendance == 'Present' ? 'selected' : '').'>Present</option>
                                            <option value="Late" '.($attendance == 'Late' ? 'selected' : '').'>Late</option>
                                            <option value="Excuse" '.($attendance == 'Excuse' ? 'selected' : '').'>Excuse</option>
                                            <option value="Absent" '.($attendance == 'Absent' ? 'selected' : '').'>Absent</option>
                                        </select>
                                    </td>
                                </tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
            
            <!-- Add a submit button and align it to the right -->
            <div style="text-align: right; margin-right: 50px; margin: 20px 20px;">
                <button type="submit" class="btn btn-primary">Update Attendance & Recitation</button>
            </div>
        </form>
    </section>





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








    <script src="/Storage/Boostrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>