<?php
    // Establish the database connection
    $connection = new mysqli('localhost', 'root', '', 'attendance', 3306);

    // Check for connection errors
    if ($connection->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    } else {
        // echo "Connection successful!";
    }

?>