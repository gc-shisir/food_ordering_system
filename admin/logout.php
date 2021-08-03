
<?php
  include('../config/constants.php');
  session_destroy();
  header('location:'.SITE_URL.'admin/login.php')
?>