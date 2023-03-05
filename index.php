<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="This is a description of the Football Club page. The Football Club is a professional soccer team based in Mannheim, Germany. The club was founded in 1995 and has won 28 championships.">
  <meta name="keywords" content="Football Club, soccer, championships">
  <meta name="author" content="Paata Grigalashvili">

  <title>FOOTBALL CLUB - Home</title>
  <!-- Other meta tags, stylesheets, and scripts can be added here -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <!-- Header content goes here -->
    <a href="#">
      <img src="logo.svg" id="logo" alt="Football Club Logo">
      <h1>Football Club</h1>
    </a>
  </header>
  <input type="checkbox" id="login" style="display:none">
  <input type="checkbox" id="login-failed" style="display:none" checked>
  <nav>
    <!-- Navigation content goes here -->
    <a href="#">Home</a>
    <a href="#">Gallery</a>
    <a href="#">Links</a>
    <a id="user-area">User Area</a>
    <?php 
    session_start();
    if($_SESSION['user']) {
?><form action="login.php" method="post">
<button type="submit" name="logout" id="logout">Logout</button>
</form>
</nav>
<?php
    } else {
      ?>

    <label for="login">Login</label>
  </nav>
  <section id="login-field">
    <label for="login">X</label>
    <form action="login.php" method="post">
      <input type="email" name="email" id="email" placeholder="Email">
      <input type="password" name="password" id="password" placeholder="Password">
      <button type="submit">Login</button>
    </form>
  </section>
    <?php } ?>
  <content>
  <main>
    <!-- Main content goes here -->
    
  </main>
  <aside>
    <!-- A Side Content goes here -->
    <match>
      <section><opponent>One VS Another</opponent><br>
        Location:<br>
        Date:<br>
       Time:</section>
    </match>
    <match>
    <section><opponent>One VS Another</opponent><br>
      Location:<br>
        Date:<br>
       Time:</section>
    </match>
    <match>
      <section><opponent>One VS Another</opponent><br>
        Location:<br>
        Date:<br>
       Time:</section>
    </match>
  </aside>
</content>
  <footer>
    <!-- Footer content goes here -->
    (c) 2023 Football club
  </footer>
</body>
</html>