<?php
$connection = mysqli_connect("localhost", "root", "", "succession");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

?>
