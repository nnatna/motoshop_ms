<?php
    $server = "localhost";
    $db = "motoshop_db";
    $user = "root";
    $password = "";
    $conn = new mysqli($server,$user,$password,$db);
    if($conn->connect_error){
    die("Connection Error : " . $conn->connect_error);
    }
    // echo("Connected successfully!!");
?>