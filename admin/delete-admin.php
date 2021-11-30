<?php
  require ('../config/constants.php');

  $id=$_GET['id'];

  $sql="DELETE FROM tbl_admin WHERE id=$id";

  $result=mysqli_query($conn,$sql);

  if($result){
    // session_start();
    $_SESSION['delete']="<div class=\"success\">Admin deleted Successfully</div>";
    header('location:'.SITE_URL.'admin/manage-admin.php');
  }else{
    // session_start();
    $_SESSION['delete']="<div class=\"error\">Failed to delete admin</div>";
    header('location:'.SITE_URL.'admin/manage-admin.php');
  }

?>