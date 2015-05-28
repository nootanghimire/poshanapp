<?php
  $user = "root";
  $pass = "toor";
  $host = "localhost";
  $db = "urja_food_app";
  $link = mysqli_connect($host, $user, $pass, $db) or die('{"error":"Cannot Connect to Database: '.mysqli_error($link).'"}');

  ?>