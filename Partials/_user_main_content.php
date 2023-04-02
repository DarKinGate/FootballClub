<?php
require_once("db_user.php");
if (isset($row['ID'])) {
?>

    <fieldset id="user_display">

        <legend>Player Data</legend>
        <label>Firstname</label><input type="text" value="<?php echo ($row['Name']); ?>" disabled></input>
        <label>Lastname</label><input type="text" value="<?php echo ($row['Last_Name']); ?>" disabled></input>
        <label>Email</label><input type="text" value="<?php echo ($row['Email']); ?>" disabled></input>
        <label>Position</label><input type="text" value="<?php echo ($row['Position']); ?>" disabled></input>
        <label>Notes</label><textarea disabled><?php echo ($row['Notes']); ?></textarea>
    </fieldset>
<?php } else { ?>
    <style>
        fieldset#user_display {
            width: 90%;
            position: relative;
            left: 50%;
            transform: translatex(-50%);
            height: auto;
        }

        legend,
        label {
            color: red;
            display: relative;
            text-shadow: 0px 0px 3px black;
        }
    </style>
    <fieldset id="user_display">
        <legend>ERROR</legend>
        <label>Error Message</label><input tyle="text" value="User Not Found!" disabled></input>
    </fieldset>
<?php } ?>