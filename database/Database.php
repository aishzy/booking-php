<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "booking_system";

    // Create connection 
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection 
    if ($conn -> connect_error) { 
        die("Connection Failed: " . $conn -> connect_error);
    }
        echo "Connection Successful.";

    // Create database if not exist
    $sql = "CREATE DATABASE IF NOT EXIST $database";
        if ($conn -> $query($sql) === true) {
            echo "Database $database created successfully.";
        } else {
            echo "Error creating database: " . $conn -> error;
        }
?>