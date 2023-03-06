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
input[name="cr_database"]{
    background: var(--light-gray);
  border: 2px solid var(--too-dark-gray);
  border-radius: 0rem 0.5rem 0.5rem 0.5rem;
  padding: 0.5rem;
  font-size: clamp(16px, 2vw, 20px);
  color: var(--black);
  text-shadow: 0px 0px 2px var(--very-light-gray);
  display:block;
  width:100%;
}
label[for="cr_database"]{
  display:table;
  margin-top: 1rem;
  background: var(--light-gray);
  border: 2px solid var(--too-dark-gray);
  border-bottom:none;
  border-radius: 0.5rem 0.5rem 0 0;
  padding: 0 0.5rem;
  margin-top: 1rem;
  z-index: 1;
}
    </style>
      <?php } 
          $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
          $result = $conn->query($sql);
      if(isset($_POST['cr_database'])){
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
                Authority VARCHAR(255) NOT NULL
                )";
                if ($conn->query($sql) === FALSE) {
                    echo "Error creating table: " . $conn->error;
                }
            header("Location: install_db.php" );
            exit();
           
          }
          echo ($result->num_rows);
        // Check if table exists, create new one if it doesn't
       
      }
      if ($result->num_rows == 1) {
        header("Location: index.php" );
        exit();
      }
      ?>

<fieldset id="user_display">
    
    <legend>Database Control</legend>
    <?php  
        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
        $result = $conn->query($sql);
     if ($result->num_rows == 0) { ?><form method="post"><label for="cr_database">Create Databaste</label><input type="submit" name="cr_database" value="Create Database"></input></form> <?php } ?>

</fieldset>