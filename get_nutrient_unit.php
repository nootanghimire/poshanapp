<?php

  if(!isset($_GET['id'])){
    //die('{"error":"id not defined!"}');
    die();
  }

  require_once 'db.php';

  if($stmt =  mysqli_prepare($link, "SELECT unit FROM nutrients WHERE id=? ;")){
    mysqli_stmt_bind_param($stmt,'i',$_GET['id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $unit);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    die($unit);
  }

  //echo '{"error":"no unit found!"}' // <<-- do in other iterations