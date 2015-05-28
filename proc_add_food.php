<?php

  if(!isset($_POST['send_param'])){
    die('{"error":"How did you come here?"}');
  }

  //decode send_param;

  $everything = json_decode($_POST['send_param'],true);

  /*
   * $everything['food_name']
   * $everything['food_type']
   * $everything['need_to_cook'] <-- if isset then
   * ^^ Insert These in foods and get food id, everything is a 's'
   *
   * $everything['nutrients'] <-- foreach key and value
   * insert into nutrients_in_foods values(null, food_id, key, value)
   * for bind_param food_id and key are 'i', value is 'd'
   * ($stmt, 'iid', $f_id, $key, $value);
   */

