<?php 
require_once('db_connect.php');
$user = $_SESSION["user"];
if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM fb_players where ID='$user_id'";
} else {
$sql = "SELECT * FROM fb_players where Email='$user'";
}
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>