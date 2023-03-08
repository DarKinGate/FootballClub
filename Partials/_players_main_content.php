<?php 
require_once('db_connect.php');
?>
<style>
  <?php require('./styles/user_view.css') ?>
</style>   
<table id="all_users">
    <tr id="header">
    <th id="first_name">Firstname</th>
    <th id="last_name">Lastname</th>
    <th id="position">Position</th>
    <th id="view_player"> View Player </th>
</tr>
    <?php
   


    $sql = "SELECT * FROM fb_players HAVING Authority>2";
$result = mysqli_query($conn, $sql);
while($rows = mysqli_fetch_array($result)){
    
    ?>
    <tr class="all_users" id="<?php echo($rows['ID']); ?>">
   <td><input type="text" value="<?php echo($rows['Name']); ?>" size="<?php echo(strlen($rows['Name'])); ?>" disabled></input></td>
    <td><input type="text" value="<?php echo($rows['Last_Name']); ?>" size="<?php echo(strlen($rows['Last_Name'])); ?>" disabled></input></td>
    <td><input type="text" value="<?php echo($rows['Position']); ?>" size="<?php echo(strlen($rows['Position'])); ?>" disabled></input></td>
    <td><a id="view_user" href="./user.php?id=<?php echo($rows['ID']) ?>">View Player</a></td>
</tr>
<?php
} ?>
</tab>
