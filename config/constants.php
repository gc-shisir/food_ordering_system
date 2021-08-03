<?php 

  session_start();

  define('SITE_URL','http://localhost/projects/food_ordering_system/');
  define('HOST','localhost');
  define('DB_USER','root');
  define('DB_PASSWORD','');
  define('DB_NAME','food_ordering_system');

  // 1. creating connection
  $conn=mysqli_connect(HOST,DB_USER,DB_PASSWORD) or die(mysqli_error);
  // 2. Selecting database
  $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error);
?>