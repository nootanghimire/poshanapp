<?php
require_once 'db.php';

$sql = "SELECT DISTINCT * FROM nutrients;";

$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
          echo "<option value='" . $row["id"]. "'>" . $row["nutrient_name"]. "</option>\n";
    }
}