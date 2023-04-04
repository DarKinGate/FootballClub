<?php
if (isset($row['Authority']) && $row['Authority'] == 1) {
    $url = $_SERVER['DOCUMENT_ROOT'];
    require_once("$url" . "/db_user.php");
    if (isset($row['ID'])) {
?>
        <style>
            <?php require("$url" . "/styles/user_view.css") ?>
            a[id="add_player"] {
                height: 2rem;
                text-align: center;
                background-color: #333;
                display: inline-block;
                position: relative;
                left: 50%;
                transform: translatex(-50%);
                padding: 0.25rem 0.5rem;
                border-radius: 0rem 0rem 1rem 1rem;
                text-decoration: none;
                color: var(--light-gray);
                line-height: 2rem;
                border: 2px solid var(--light-gray);
                border-top: none;
                font-size: 1.5rem;
                transition: 0.5s;
            }
            a[id="add_player"]:first-of-type{
                margin-top: 1rem;
                border-radius: 1rem 1rem 0rem 0rem;
                border-top: 2px solid var(--light-gray);
                border-bottom: none;
            }
            a[id="add_player"]:hover{
                background-color: var(--light-gray);
                color: var(--very-dark-gray);
                border-color: #333;
            }
        </style>
        <a href="../add_a_new_player.php" id="add_player">Add a New Player</a>
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
            // if (isset($_GET['sort'])) {
            //     if ($sort = ("ORDER BY " . $_GET['sort'])) {
            //         echo ($sort . ' REVERSE');
            //     } else {
            //         $sort = ("ORDER BY " . $_GET['sort']);
            //         echo ($sort);
            //     }
            // }
            if (isset($_POST['del-user'])) {
                $userID = $_POST['del-user'];
                $sql = "DELETE FROM fb_players where ID=$userID";
                $result = mysqli_query($conn, $sql);
            }


            $sql = "SELECT * FROM fb_players WHERE Authority >= 2 $sort";
            $result = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_array($result)) {
                if ($rows['Authority'] == 3) {
                    $authority = 'Player';
                } else if ($rows['Authority'] == 2) {
                    $authority = 'Content Manager';
                } else {
                    $authority = 'Admin';
                }
            ?>
                <section id="<?php echo ($rows['ID']); ?>">
                    <tr class="all_users" id="<?php echo ($rows['ID']); ?>">
                        <td><input type="text" value="<?php echo ($rows['Name']); ?>" size="<?php echo (strlen($rows['Name'])); ?>" disabled></input></td>
                        <td><input type="text" value="<?php echo ($rows['Last_Name']); ?>" size="<?php echo (strlen($rows['Last_Name'])); ?>" disabled></input></td>
                        <td><input type="text" value="<?php echo ($rows['Position']); ?>" size="<?php echo (strlen($rows['Position'])); ?>" disabled></input></td>
                        <td><a id="view_user" href="../user.php?id=<?php echo ($rows['ID']) ?>">View Player</a></td>
                        <td><input type="text" value="<?php echo ($authority); ?>" size="<?php echo (strlen($authority)); ?>" disabled></input></td>
                        <td>
                            <form method="post"><label for="user_id:<?php echo ($rows['ID']); ?>" class="action">Delete User</label><input class="action" type="submit" name="del-user" id="user_id:<?php echo ($rows['ID']); ?>" value="<?php echo ($rows['ID']); ?>"></input></form>
                        </td>
                    <?php
                } ?>
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
            <?php }
        } ?>
        </table>
        <a href="../add_a_new_player.php" id="add_player">Add a New Player</a>