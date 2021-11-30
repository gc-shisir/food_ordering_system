<?php
  include('../config/constants.php');
  if(isset($_GET['id']) && isset($_GET['image_name'])){
    // get value and delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    
    // Remove the image file if available
    if($image_name!=''){
      $path="../images/category/".$image_name;
      // Remove image
      $remove=unlink($path);  //returns boolean

      // If failed to remove add error message and stop the process
      if($remove==false){
        $_SESSION['remove']="<div class=\"error\">Failed to remove category image</div>";
        header('location:'.SITE_URL.'admin/manage-category.php');
        die();
      }
    }

    // Delete data from database
    $sql="DELETE FROM tbl_category WHERE id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
      $_SESSION['delete']="<div class='success'>Category deleted successfully</div>";
      header('location:'.SITE_URL.'admin/manage-category.php');
    }else{
      $_SESSION['delete']="<div class='error'>Failed to delete category</div>";
      header('location:'.SITE_URL.'admin/manage-category.php');
    }

    // Redirect to manage_category page with success message

  }else{
    // redirect to manage-category.php
    header('location:'.SITE_URL.'admin/manage-category.php');
  }


?>