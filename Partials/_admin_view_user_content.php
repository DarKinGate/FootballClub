<?php
      require_once("db_user.php");
      if(isset($row['ID'])){
      ?>
<style>
  <?php require('./styles/admin_view.css') ?>
</style>   
<fieldset id="user_display">
 
    <legend>Player Data</legend>
    <label>Firstname</label><input type="text" value="<?php echo($row['Name']); ?>" disabled></input>
    <label>Lastname</label><input type="text" value="<?php echo($row['Last_Name']); ?>" disabled></input>
    <label>Email</label><input type="text" value="<?php echo($row['Email']); ?>" disabled></input>
    <label>Position</label><input type="text" value="<?php echo($row['Position']); ?>" disabled></input>
    <label>Notes</label><textarea disabled><?php echo($row['Notes']); ?></textarea>
</fieldset>
<fieldset id="all_users">
    <legend>Users</legend>
    <?php
    if(isset($_POST['del-user'])){
        $userID = $_POST['del-user'];
        $sql = "DELETE FROM fb_players where ID=$userID";
$result = mysqli_query($conn, $sql);
    }


    $sql = "SELECT * FROM fb_players";
$result = mysqli_query($conn, $sql);
while($rows = mysqli_fetch_array($result)){
    
    ?>
    <section id="<?php echo($rows['ID']); ?>">
   <label>Firstname</label><input type="text" value="<?php echo($rows['Name']); ?>" size="<?php echo(strlen($rows['Name'])); ?>" disabled></input>
    <label>Lastname</label><input type="text" value="<?php echo($rows['Last_Name']); ?>" size="<?php echo(strlen($rows['Last_Name'])); ?>" disabled></input>
    <label>Email</label><input type="text" value="<?php echo($rows['Email']); ?>" size="<?php echo(strlen($rows['Email'])); ?>" disabled></input>
    <label>Position</label><input type="text" value="<?php echo($rows['Position']); ?>" size="<?php echo(strlen($rows['Position'])); ?>" disabled></input>
    <label>Authority</label><input type="text" value="<?php echo($rows['Authority']); ?>" size="<?php echo(strlen($rows['Authority'])); ?>" disabled></input>
    <form method="post"><label for="user_id:<?php echo($rows['ID']); ?>" class="action" >Delete User</label><input class="action" type="submit" name="del-user" id="user_id:<?php echo($rows['ID']); ?>" value="<?php echo($rows['ID']); ?>"></input></form></section>
<?php
} ?>
</fieldset>
<?php } else { ?>
    <style>
        fieldset#user_display{
            width: 90%;
            position:relative;
            left:50%;
            transform: translatex(-50%);
            height: auto;
        }
        legend, label{
            color:red;
            display: relative;
            text-shadow: 0px 0px 3px black;
        }
    </style>
    <fieldset id="user_display">
    <legend>ERROR</legend>
    <label>Error Message</label><input tyle="text" value="User Not Found!" disabled></input>
</fieldset>
    <?php } ?>