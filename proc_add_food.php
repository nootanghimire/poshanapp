<?php

  if(!isset($_POST['send_param'])){
    die('{"error":"How did you come here?"}');
  }

  //decode send_param;

  //print_r($_POST['send_param']);

  $everything = json_decode($_POST['send_param'],true);

  //print_r($everything);
  /*
   * $everything['food_name']
   * $everything['food_type']
   * $everything['need_to_cook'] <-- if not equals to 1 then not selected
   * ^^ Insert These in foods and get food id, everything is a 's'
   *
   * $everything['nutrients'] <-- foreach key and value
   * insert into nutrients_in_foods values(null, food_id, key, value)
   * for bind_param food_id and key are 'i', value is 'd'
   * ($stmt, 'iid', $f_id, $key, $value);
   */

  $ndc = ($everything['need_to_cook'] == 1) ? "yes" : "no";
  $food_id = false;

  require_once 'db.php';

if($stmt = mysqli_prepare($link, "INSERT INTO foods VALUES(NULL, ?, 0, ?, ?)")){
  mysqli_stmt_bind_param($stmt,'sss', $everything['food_name'], $everything['food_type'], $ndc);
  mysqli_stmt_execute($stmt);
  $food_id = mysqli_stmt_insert_id($stmt);
  mysqli_stmt_close($stmt);
}

if($food_id === false){
  die('{"error":"Could not Add any Food"}');
}

foreach ($everything['nutrients'] as $value) {
 //print_r(json_decode($value));
 foreach ($value as $key => $actualValue) {
  if($stmt = mysqli_prepare($link,"INSERT INTO nutrients_in_food VALUES(NULL, ?, ?, ?)")){
    mysqli_stmt_bind_param($stmt,"iid", $food_id, $key, $actualValue);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
 }
}

die('{"success":"Probable Success"}');