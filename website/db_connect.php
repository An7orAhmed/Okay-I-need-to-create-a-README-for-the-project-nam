<?php
    // Prepare variables for database connection
    $username = "id4777817_iothealth";  
    $password = "dcccsemohona"; 
    $server = "localhost";
    $database = "id4777817_iothealth"; 

    // Create connection
    $conn = new mysqli($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    } 
?>