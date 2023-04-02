<?php
require_once('db_connect.php');
if (isset($_GET['id']) && $_SESSION["user"] != 'undefined') {
  $user = $_SESSION["user"];
  $id = $_GET['id'];
  $sql = "SELECT * FROM fb_players where ID='$id'";
} else if ($_SESSION["user"] != 'undefined') {
  $user = $_SESSION["user"];
  $sql = "SELECT * FROM fb_players where Email='$user'";
} else {
  if ($_SERVER['REQUEST_URI'] == '/users/') {
  } else {
    header("Location: /index.php");
    exit();
  }
}
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
