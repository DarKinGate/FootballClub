<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $title = "User Area" ?>
<?php include("Partials/_head.php");
    if ($_SESSION['user'] == "undefined") {
      header("Location: index.php");
      exit();
  }
   ?>
</head>
<body>
  <header>
  <?php include("Partials/_header.php"); ?>
  </header>
  <?php include("Partials/_nav.php"); ?>
  <content>
  <?php if (strpos($url, '/user.php') === 0) { ?>
    <style>
        main {
  width: 100%;
  flex-shrink: 0;
  display: flex;
  flex-basis: auto;
  flex-shrink: 0;
  flex-grow: 0;
}
    </style>
      <?php } ?>
    <main>
  <?php 
include("db_user.php");
if(isset($row['Authority']) && $row['Authority'] < 2){
  include("Partials/_admin_view_user_content.php");
} else {
   include("Partials/_user_main_content.php");
  }
   ?>
</main>
<aside>
  <?php include("Partials/_side_content.php"); ?>
</aside>
</content>
  <?php include("Partials/_footer.php"); ?>
</body>
</html>