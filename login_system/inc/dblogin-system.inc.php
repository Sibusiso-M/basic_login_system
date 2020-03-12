<?php

//Database connection
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login_system";

$connection = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$connection) {
    die("Connection Failed!" . mysqli_connect_error());
}