<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "football_db";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>