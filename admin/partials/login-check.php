<?php 
// include('../../config/constants.php');
  // Authorization/Access-Control
  if(!isset($_SESSION['user'])){
    $_SESSION['user-not-logged-in']="<div class=\"error text-center \">Please log in to access admin panel</div>";
    header('location:'.SITE_URL.'admin/login.php');
  }
?>