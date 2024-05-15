<?php
$connection = mysqli_connect("localhost", "root", "pdjdde5i5njkea8", "succession");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

?>
