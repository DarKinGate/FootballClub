<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "football_db";

$conn = mysqli_connect($db_host, $db_user, $db_pass);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$url = $_SERVER['REQUEST_URI'];
$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header("Location: install_db.php");
    exit();
}
$conn->select_db($db_name);
