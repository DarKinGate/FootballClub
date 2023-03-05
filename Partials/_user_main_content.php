<?php 
 if($_SESSION == null) {
    header("Location: /index.php");
  }
require_once('db_connect.php');
$sql = "SELECT Email, Name, Last_Name, Position, Notes FROM fb_players where Email='$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>
<fieldset id="user_display">
    <legend>Player Data</legend>
    <label>Firstname</label><input type="text" value="<?php echo($row['Name']); ?>" disabled></input>
    <label>Lastname</label><input type="text" value="<?php echo($row['Last_Name']); ?>" disabled></input>
    <label>Email</label><input type="text" value="<?php echo($row['Email']); ?>" disabled></input>
    <label>Position</label><input type="text" value="<?php echo($row['Position']); ?>" disabled></input>
    <label>Notes</label><textarea disabled><?php echo($row['Notes']); ?></textarea>
</fieldset>