<input type="checkbox" id="login" style="display:none">
  <input type="checkbox" id="login-failed" style="display:none" checked>
  <nav>
    <!-- Navigation content goes here -->
    <a href="#">Home</a>
    <a href="#">Gallery</a>
    <a href="#">Links</a>
    <span></span>
    <?php 
    session_start();
    if($_SESSION['user']) {
?><a id="user-area">User Area</a>
<form action="login.php" method="post">
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