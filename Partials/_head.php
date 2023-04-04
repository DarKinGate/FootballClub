<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="This is a description of the Football Club page. The Football Club is a professional soccer team based in Mannheim, Germany. The club was founded in 1995 and has won 28 championships.">
<meta name="keywords" content="Football Club, soccer, championships">
<meta name="author" content="Paata Grigalashvili">
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if ($_SESSION == null) {
  $_SESSION["user"] = "undefined";
}
$url = $_SERVER['REQUEST_URI'];
if ($_SESSION["user"] != "undefined") {
  $user = $_SESSION["user"];
?><title>FOOTBALL CLUB - <?php echo ($title) ?> - <?php echo ($user) ?></title>
<?php
} else if ($url == '../login.php') {
?><title>FOOTBALL CLUB - Login</title>
<?php
} else {
?>
  <title>FOOTBALL CLUB - <?php echo ($title) ?></title><?php } ?>
<!-- Other meta tags, stylesheets, and scripts can be added here -->
<link rel="stylesheet" href="../styles/style.css">