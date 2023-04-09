<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "football_db";

$conn = mysqli_connect($db_host, $db_user, $db_pass);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$url = $_SERVER['REQUEST_URI'];
if ($url == '/install_db.php') { ?>
  <style>
    main {
      width: 100%;
      flex-shrink: 0;
    }

    input {
      background: var(--light-gray);
      border: 2px solid var(--too-dark-gray);
      border-radius: 0.5rem;
      padding: 0.5rem;
      font-size: clamp(16px, 2vw, 20px);
      color: var(--black);
      text-shadow: 0px 0px 2px var(--very-light-gray);
      display: block;
      width: 60%;
      place-content: center;
      margin-bottom: 0.5rem;
      text-align: center;
    }

    input[type="submit"] {
      width: auto;
    }

    label {
      display: table;
      margin-top: 1rem;
      background: var(--light-gray);
      border: 2px solid var(--too-dark-gray);
      border-bottom: none;
      border-radius: 0.5rem 0.5rem 0 0;
      padding: 0 0.5rem;
      margin-top: 1rem;
      width: 50%;
      text-align: center;
    }

    fieldset[id="user_display"] {
      position: relative;
      left: 50%;
      transform: translatex(-50%);
      display: flex;
      flex-shrink: 0;
    }

    fieldset[id="user_display"]>form[method="post"] {
      display: flex;
      flex-shrink: 0;
      align-items: center;
      flex-direction: column;
    }
  </style>
<?php }
$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
$result = $conn->query($sql);
if (isset($_POST['Admin_Name']) && $_POST['Admin_Name'] != 'Undefined') {
  $adname = $_POST['Admin_Name'];
  $admail = $_POST['Admin_Email'];
  $adpass = $_POST['Admin_Password'];
  $adpass2 = $_POST['Repeat_Admin_Password'];
}
if (isset($_POST['cr_database']) && $admail != null &&  $adname != null && $adpass != null && $adpass2 != null && $admail != 'Undefined' && $adname != 'Undefined' && $adpass != 'Undefined' && $adpass2 != 'Undefined' && $adpass == $adpass2) {
  if ($result->num_rows == 0) {
    $create_db = "CREATE DATABASE $db_name";
    $conn->query($create_db);

    $conn->select_db($db_name);
    $sql = "CREATE TABLE IF NOT EXISTS fb_players (
                ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                Email VARCHAR(255) NOT NULL,
                Password VARCHAR(255) NOT NULL,
                Name VARCHAR(255) NOT NULL,
                Last_Name VARCHAR(255) NOT NULL,
                Phone VARCHAR(255) NOT NULL,
                Notes LONGTEXT NOT NULL,
                Position VARCHAR(255) NOT NULL,
                Authority ENUM('1', '2', '3') NOT NULL
                )";
    if ($conn->query($sql) === FALSE) {
      echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE IF NOT EXISTS upcoming_matches (
                  ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  vs VARCHAR(255) NOT NULL,
                  location VARCHAR(255) NOT NULL,
                  match_date date NOT NULL,
                  match_time time NOT NULL
                  )";
    if ($conn->query($sql) === FALSE) {
      echo "Error creating table: " . $conn->error;
    }
    $sql = "INSERT INTO `fb_players` (`ID`, `Email`, `Password`, `Name`, `Last_Name`, `Phone`, `Notes`, `Position`, `Authority`) VALUES (NULL, '$admail', '$adpass', '$adname', '', '', '', '', '1');";
    if ($conn->query($sql) === FALSE) {
      echo "Error creating Admin: " . $conn->error;
    } else {
      $_SESSION['user'] = $admail;
      $_SESSION['name'] = ucfirst($adname);
    }
    $sql = "CREATE TABLE IF NOT EXISTS gallery (
      ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      img_url VARCHAR(255) NOT NULL,
      img_title VARCHAR(255) NOT NULL,
      img_description VARCHAR(255) NOT NULL
      )";
if ($conn->query($sql) === FALSE) {
echo "Error creating table: " . $conn->error;
}
    header("Location: install_db.php");
    exit();
  }
  echo ($result->num_rows);
  // Check if table exists, create new one if it doesn't

} else if (isset($_POST['cr_database'])) {
  echo "Please Repeat Password Correctly";
}
if ($result->num_rows == 1) {
  header("Location: index.php");
  exit();
}
?>

<fieldset id="user_display">

  <legend>Database Control</legend>
  <?php
  $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
  $result = $conn->query($sql);
  if ($result->num_rows == 0) { ?><form method="post">
      <label for="Admin_Name">Admin Name</label><input type="text" name="Admin_Name" id="Admin_Name"><br>
      <label for="Admin_Email">Admin Email</label><input type="email" name="Admin_Email" id="Admin_Email"><br>
      <label for="Admin_Password">Admin Password</label><input type="password" name="Admin_Password" id="Admin_Password">
      <label for="Repeat_Admin_Password">Repeat Admin Password</label><input type="password" name="Repeat_Admin_Password" id="Repeat_Admin_Password">
      <input type="submit" name="cr_database" value="Register">

    </form> <?php } ?>

</fieldset>