<?php
$connection = mysqli_connect("localhost", "root", "pdjdde5i5njkea8", "succession");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

// Query to select data from login_table

$sql = "SELECT * FROM login_table";
$result = mysqli_query($connection, $sql);

// Check if the query executed successfully
if ($result) {
    // Check if there are rows returned
    echo("<br>");
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row and display the data
        while ($row = mysqli_fetch_assoc($result)) {
            // Print or process the data as needed
            print_r($row);
        }
    } else {
        echo "No records found in login_table";
    }
} else {
    echo "Error retrieving data: " . mysqli_error($connection);
}

// Close the result set
mysqli_free_result($result);
?>
