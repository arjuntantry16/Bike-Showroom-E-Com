<?php

    $serverName = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "showroom";

    $conn = mysqli_connect($serverName,$username,$password,$databaseName);

    if(!$conn){
        die("Cannot connect to database".$connect_error);
    }