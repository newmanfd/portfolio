<?php 
    // create the connection to the mysql server
    // (host, user, password, database name)
    $conn = mysqli_connect('localhost', 'root', '123456', 'phpdiscussionforum');

    // check if the connection failed
    if(mysqli_connect_errno()) { 
        echo 'Failed to connect to MySQL database. Error: ' . mysqli_connect_errno();
    }
?>