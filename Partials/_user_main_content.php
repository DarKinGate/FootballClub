<?php if ($url == '/user.php') { ?>
    <style>
        main {
  width: 100%;
  flex-shrink: 0;
}
    </style>
      <?php } 
      require_once("db_user.php")
      ?>

<fieldset id="user_display">
    
    <legend>Player Data</legend>
    <label>Firstname</label><input type="text" value="<?php echo($row['Name']); ?>" disabled></input>
    <label>Lastname</label><input type="text" value="<?php echo($row['Last_Name']); ?>" disabled></input>
    <label>Email</label><input type="text" value="<?php echo($row['Email']); ?>" disabled></input>
    <label>Position</label><input type="text" value="<?php echo($row['Position']); ?>" disabled></input>
    <label>Notes</label><textarea disabled><?php echo($row['Notes']); ?></textarea>
</fieldset>