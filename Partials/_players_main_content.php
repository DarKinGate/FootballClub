<?php 
require_once('db_connect.php');
?>
<style>
  <?php require('./styles/user_view.css') ?>
</style>   
<fieldset id="all_users">
    <legend>Players</legend>
    <?php
   


    $sql = "SELECT * FROM fb_players HAVING Authority>2";
$result = mysqli_query($conn, $sql);
while($rows = mysqli_fetch_array($result)){
    
    ?>
    <section id="<?php echo($rows['ID']); ?>">
   <label>Firstname</label><input type="text" value="<?php echo($rows['Name']); ?>" size="<?php echo(strlen($rows['Name'])); ?>" disabled></input>
    <label>Lastname</label><input type="text" value="<?php echo($rows['Last_Name']); ?>" size="<?php echo(strlen($rows['Last_Name'])); ?>" disabled></input>
    <label>Position</label><input type="text" value="<?php echo($rows['Position']); ?>" size="<?php echo(strlen($rows['Position'])); ?>" disabled></input>
    <a id="view_user" href="./user.php?id=<?php echo($rows['ID']) ?>">View Player</a>
 </section>
<?php
} ?>
</fieldset>
