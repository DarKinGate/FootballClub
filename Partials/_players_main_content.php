<?php 
require_once("../db_user.php");
?>
<style>
  <?php require('../styles/user_view.css') ?>
</style>   
<table id="all_users">
    <tr id="header">
    <th id="first_name"><a href="?sort=Name">Firstname</a></th>
    <th id="last_name"><a href="?sort=Last_Name">Lastname</a></th>
    <th id="position"><a href="?sort=Position">Position</a></th>
</tr>
    <?php
if(isset($_GET['sort'])){
    $sort = ("ORDER BY " . $_GET['sort']);
} else {
    $sort = "";
}
    $sql = "SELECT * FROM fb_players HAVING Authority>2 $sort";
$result = mysqli_query($conn, $sql);
while($rows = mysqli_fetch_array($result)){
    
    ?>
    <tr class="all_users" id="<?php echo($rows['ID']); ?>">
   <td><input type="text" value="<?php echo($rows['Name']); ?>" size="<?php echo(strlen($rows['Name'])); ?>" disabled></input></td>
    <td><input type="text" value="<?php echo($rows['Last_Name']); ?>" size="<?php echo(strlen($rows['Last_Name'])); ?>" disabled></input></td>
    <td><input type="text" value="<?php echo($rows['Position']); ?>" size="<?php echo(strlen($rows['Position'])); ?>" disabled></input></td></tr>
<?php
} ?>
</table>
