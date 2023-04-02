<!DOCTYPE html>
<html lang="en">

<head>
  <?php $title = "User Area" ?>
  <?php include("Partials/_head.php");
  include("db_user.php");
  //   if ($_SESSION['user'] == "undefined") {
  //     header("Location: index.php");
  //     exit();
  // }
  ?>
</head>

<body>
  <header>
    <?php include("Partials/_header.php"); ?>
  </header>
  <?php include("Partials/_nav.php"); ?>
  <content>
    <?php
    if (isset($row['Authority']) && $row['Authority'] < 2 && $row['Authority'] != null && isset($_SESSION['user']) && $row['Email'] == $_SESSION['user'] && (strpos($url, '/user.php') === 0)) {
      $url = $_SERVER['DOCUMENT_ROOT'];
    ?>
      <style>
        <?php include($url . "/styles/admin_view.css"); ?>
      </style>
    <?php } else if (strpos($url, '/user.php') === 0) { ?>
      <style>
        main {
          width: 100%;
          flex-shrink: 0;
          display: flex;
          flex-basis: auto;
          flex-shrink: 0;
          flex-grow: 0;
        }

        content {
          height: 72.6%
        }
      </style>
    <?php } ?>
    <main>
      <?php
      if (isset($row['Authority']) && $row['Authority'] < 2 && $row['Authority'] != null && isset($_SESSION['user']) && $row['Email'] == $_SESSION['user']) {
        $url = $_SERVER['DOCUMENT_ROOT'];
        include("Partials/_admin_page.php");
      } else {
        include("Partials/_user_main_content.php");
      }
      ?>
    </main>
  </content>
  <?php include("Partials/_footer.php"); ?>
</body>

</html>