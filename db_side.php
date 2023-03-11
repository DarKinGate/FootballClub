<?php 
require_once('db_connect.php');
$sql = "SELECT *
FROM upcoming_matches
WHERE match_date >= CURDATE()
ORDER BY ABS(DATEDIFF(match_date, CURDATE()))
LIMIT 3;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
    echo ("<match>
    <section><opponent>" . $row['vs'] . "</opponent><br>
      Location: " . $row['location'] .
      "<br>Date: " . $row['match_date'] .
     "<br>Time: " . $row['match_time'] .
  "</section></match>");
}
?>