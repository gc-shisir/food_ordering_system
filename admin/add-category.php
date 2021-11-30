<?php include('partials/header.php'); ?>
<!-- Navbar section -->
<?php include('./partials/menu.php'); ?>

  <div class="main-content">
    <div class="wrapper">
      <h2>Add Category</h2>
      <br>
      <?php 
        if(isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
      ?>
      <br>
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
          <tr>
            <td>Title:</td>
            <td><input type="text" name="title" placeholder="Category title"></td>
          </tr>
          <tr>
            <td>Select Image:</td>
            <td><input type="file" name="image"></td>
          </tr>
          <tr>
            <td>Featured</td>
            <td>
              <input type="radio" name="featured" value="Yes">Yes
              <input type="radio" name="featured" value="No">No
            </td>
          </tr>
          <tr>
            <td>Active:</td>
            <td>
              <input type="radio" name="active" value="Yes">Yes
              <input type="radio" name="active" value="No">No
            </td>
          </tr>
          <tr colspan="2">
            <input type="submit" value="Add category" name="submit">
          </tr>
        </table>
      </form>
    </div>
  </div>
<?php include('partials/footer.php'); ?>

<?php
  if(isset($_POST['submit'])){

    $title=$_POST['title'];

    if(isset($_POST['featured'])){
      $featured=$_POST['featured'];
    }else{
      $featured="No";
    }

    if(isset($_POST['active'])){
      $active=$_POST['active'];
    }else{
      $active="No";
    }

    // Check whether image is selected or not
    // print_r($_FILES['image']);

    // die(); // break the code
    if($_FILES['image']['name']){
      // To upload image we need image name, source path and destination path
      $image_name=$_FILES['image']['name'];

      // Auto rename  image
      // Get the extension of the image (jpg,png,gif,etc)
      $ext=end(explode('.',$image_name));

      // Rename the image
      $image_name="Food_Category_".rand(000,999).'.'.$ext;

      $source_path=$_FILES['image']['tmp_name'];
      $destination_path="../images/category/".$image_name;

      // Finally upload the image
      $upload=move_uploaded_file($source_path,$destination_path);
      // echo $upload;

      // Check whether the image is uploaded or not
      // If the image is not uploaded then stop the process so that rest of the values doesnot enter the database and 
      // display error message
      if($upload==false){
        // Set message
        $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
        // redirect
        header('location:'.SITE_URL.'admin/add-category.php');
        // Stop the process
        die();
      }

    }else{
      $image_name='';
    }

    $sql="INSERT INTO tbl_category SET 
      title='$title',
      image_name='$image_name',
      featured='$featured',
      active='$active'
    ";

    // Executing query and saving in database
    
    $result=mysqli_query($conn,$sql);
    
    if($result==true){
      $_SESSION['add']="<div class='success'>Category added successfully</div>";
      header('location:'.SITE_URL.'admin/manage-category.php');
    }else{
      $_SESSION['add']="<div class='error'>Failed to add category</div>";
      header('location:'.SITE_URL.'admin/add-category.php');
    }
  }
?>

