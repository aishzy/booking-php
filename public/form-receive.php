<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    }

    echo "Welcome " . $_POST['username'];
?>