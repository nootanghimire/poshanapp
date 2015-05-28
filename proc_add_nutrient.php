<?php

if(!isset($_POST['submit'])) {
  die('{"error":"Cannot Come here like this!"}');
}

$n_name = $_POST['n_name'];
$n_type = $_POST['n_type'];
$unit_type = $_POST['unit_type'];
$n_unit = $_POST['n_unit'];

require_once 'db.php';

if($stmt = mysqli_prepare($link, "SELECT * FROM nutrients where nutrient_name=?")){
  mysqli_stmt_bind_param($stmt, 's', $n_name);
  mysqli_stmt_execute($stmt);
  $affectedRows = mysqli_stmt_affected_rows($stmt);
  mysqli_stmt_close($stmt);
  if($affectedRows > 0){
    die('{"error":"Nutrient Already Available!"}');
  }
}

if($stmt = mysqli_prepare($link, "INSERT INTO nutrients VALUES(NULL, ?, ?, ?, ?)")){
  mysqli_stmt_bind_param($stmt,'ssss', $n_name, $n_type, $unit_type, $n_unit);
  mysqli_stmt_execute($stmt);
  die('{"success":"Nutrient Added Successfully"}');
}
