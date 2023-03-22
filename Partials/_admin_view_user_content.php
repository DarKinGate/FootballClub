<?php
if(isset($row['Authority']) && $row['Authority'] == 1){
    $url = $_SERVER['DOCUMENT_ROOT'];
      require_once("$url" . "/db_user.php");
      if(isset($row['ID'])){
      ?>
<style>
  <?php require("$url" . "/styles/user_view.css") ?>
  input[id="add_new_player"]{
    position: relative;
    height: 100px;
    display:block;
  }
</style>   
<input id="add_new_player" type="button" value="Add New Player"><br style="clear: both" />
<table id="all_users">
    <tr id="header">
    <th id="first_name"><a href="?sort=Name">Firstname</a></th>
    <th id="last_name"><a href="?sort=Last_Name">Lastname</a></th>
    <th id="position"><a href="?sort=Position">Position</a></th>
    <th id="view_player"> View Player </th>
    <th id="Authority"><a href="?sort=Authority">Authority</a></th>
    <th id="Delete_User"> Delete User </th>
</tr>
    <?php
        $sort = null;
    if(isset($_GET['sort'])){
        if($sort = ("ORDER BY " . $_GET['sort'])){
            echo ($sort . ' REVERSE');
        } else {
        $sort = ("ORDER BY " . $_GET['sort']);
        echo ($sort);
        }
    }
    if(isset($_POST['del-user'])){
        $userID = $_POST['del-user'];
        $sql = "DELETE FROM fb_players where ID=$userID";
$result = mysqli_query($conn, $sql);
    }


    $sql = "SELECT * FROM fb_players WHERE Authority >= 2 $sort";
$result = mysqli_query($conn, $sql);
while($rows = mysqli_fetch_array($result)){
    if($rows['Authority'] == 3){
        $authority = 'Player';
    } else if ($rows['Authority'] == 2){
        $authority = 'Content Manager';
    } else {
        $authority = 'Admin';
    }
    ?>
    <section id="<?php echo($rows['ID']); ?>">
    <tr class="all_users" id="<?php echo($rows['ID']); ?>">
   <td><input type="text" value="<?php echo($rows['Name']); ?>" size="<?php echo(strlen($rows['Name'])); ?>" disabled></input></td>
    <td><input type="text" value="<?php echo($rows['Last_Name']); ?>" size="<?php echo(strlen($rows['Last_Name'])); ?>" disabled></input></td>
    <td><input type="text" value="<?php echo($rows['Position']); ?>" size="<?php echo(strlen($rows['Position'])); ?>" disabled></input></td>
    <td><a id="view_user" href="../user.php?id=<?php echo($rows['ID']) ?>">View Player</a></td>
    <td><input type="text" value="<?php echo($authority); ?>" size="<?php echo(strlen($authority)); ?>" disabled></input></td>
    <td><form method="post"><label for="user_id:<?php echo($rows['ID']); ?>" class="action" >Delete User</label><input class="action" type="submit" name="del-user" id="user_id:<?php echo($rows['ID']); ?>" value="<?php echo($rows['ID']); ?>"></input></form></td>
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
    <?php }} ?>
    </table>
    <input id="add_new_player" type="button" value="Add New Player">