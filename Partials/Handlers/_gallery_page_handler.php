<?php
require_once('db_connect.php');
$user = $_SESSION["user"];
$sql = "SELECT * FROM fb_players";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($_SESSION["user"] != 'undefined'){
    if (isset($row['Authority']) && $row['Authority'] == 1) {
        if (isset($row['ID'])) {
            include($host . '/Partials/Admin_View/_gallery.php');
        }
    }} else include($host . '/Partials/_gallery.php');