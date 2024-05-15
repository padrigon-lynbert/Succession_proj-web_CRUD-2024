<?php

use LDAP\Result;

    include "connection.php";

    if (isset($_GET['deleteid']))
    {
        $id = $_GET['deleteid'];

        $sql = "delete from `employee` where id=$id";
        $result = mysqli_query($connection, $sql);

        if($result)
        {
            // echo "<br> Deleted succesfully";
            header('location:AdminPage.php');
        } else {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
?>