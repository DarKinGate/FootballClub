<!DOCTYPE html>
<html lang="en">

<head>
  <?php $title = "User Area" ?>
  <?php include("../Partials/_head.php");
  include("../db_user.php");
  $user = $_SESSION["user"];
  ?>
</head>

<body>
  <header>
    <?php include("../Partials/_header.php"); ?>
  </header>
  <?php include("../Partials/_nav.php"); ?>
  <content>

    <main>
      <?php
      if (isset($row['Authority']) && $row['Authority'] == 1) {
        include("../Partials/_admin_view_user_content.php");
      } else if (isset($row['Authority']) && $row['Authority'] == 2) {
        include("../Partials/_manager_view_user_content.php");
      } else if (isset($row['Authority']) && $row['Authority'] == 3) {
        include("../Partials/_players_main_content.php");
      } else {
        include("../Partials/_guest_main_content.php");
      }
      ?>
    </main>
  </content>
  <?php include("../Partials/_footer.php"); ?>
</body>

</html>