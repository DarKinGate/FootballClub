<?php 
if ($_SESSION['user'] == "undefined") {
    header("Location: index.php");
    exit();
}
require_once('db_connect.php');
$sql = "SELECT * FROM fb_players where Email='$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>