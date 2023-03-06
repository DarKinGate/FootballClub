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
$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    $create_db = "CREATE DATABASE $db_name";
    $conn->query($create_db);
    if ($conn->query($create_db) === FALSE) {
        echo "Error creating database: " . $conn->error;
    }
}

// Select the database
$conn->select_db($db_name);

// Check if table exists, create new one if it doesn't
$sql = "CREATE TABLE IF NOT EXISTS fb_players (
ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Email VARCHAR(255) NOT NULL,
Password VARCHAR(255) NOT NULL,
Name VARCHAR(255) NOT NULL,
Last_Name VARCHAR(255) NOT NULL,
Phone VARCHAR(255) NOT NULL,
Notes LONGTEXT NOT NULL,
Position VARCHAR(255) NOT NULL,
Authority VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
}


?>