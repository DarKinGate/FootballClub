
<?php
require_once('football_db.php');
session_start();

// Sanitize user inputs
$username = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (isset($_POST['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page
    header("Location: /index.php");
    exit();
}
// Prepare and bind the SQL statement
$stmt = mysqli_prepare($conn, "SELECT * FROM fb_players WHERE Email = ? AND password = ?");
mysqli_stmt_bind_param($stmt, "ss", $username, $password);

// Set the value of the $username variable and execute the query
mysqli_stmt_execute($stmt);

// Fetch the results of the query
$result = mysqli_stmt_get_result($stmt);

// Process the results
if (mysqli_num_rows($result) == 1) {
    // Do something with the row data
    $_SESSION['user'] = $username;
    header("Location: /index.php");
} else {
$error = "Wrong username and/or password!";
require("rstyle.html");
include("index.php");
?>
    <section id="error"><?php echo $error; ?></section>
<style>
#login-failed~#login-field:checked{
  transition: 1s;
  z-index: 1;
  opacity: 1;
  transform: translate(-50%, -50%);
}
#login~#login-field::before {
content: "Wrong username and/or password!";
color: red;
position:relative;
left:10%;
font-size: 1.5rem;
}
</style>
<?php
}
// Close the database connection
mysqli_close($conn);
?>