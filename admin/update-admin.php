<?php include('partials/header.php'); ?>
<!-- Navbar section -->
<?php include('./partials/menu.php'); ?>

<?php 
  if(isset($_GET['id'])){
    $id=$_GET['id'];
  }else{
    header('location:'.SITE_URL.'admin/manage-admin.php');
  }
  // echo $id;
  $sql="SELECT * FROM tbl_admin WHERE id=$id";
  $result=mysqli_query($conn,$sql);
  if($result){
    $count=mysqli_num_rows($result);
    if($count==1){
      $row=mysqli_fetch_assoc($result);
      $full_name=$row['full_name'];
      $username=$row['username'];
    }
    else{
      header('location:'.SITE_URL.'admin/manage-admin.php');
    }
    
  }
?>

  <div class="main-content">
    <div class="wrapper">
      <h2>Update Admin</h2>
      <br>
      <br>
      <form action="" method="POST">
        <table>
          <tr>
            <td>Full Name</td>
            <td><input type="text" name="full_name" placeholder="Enter your name" value="<?php echo $full_name; ?>"></td>
          </tr>
          <tr>
            <td>Username</td>
            <td><input type="text" name="username" placeholder="Enter your username" value="<?php echo $username; ?>" ></td>
          </tr>
          <tr colspan="2">
            <input type="hidden" name="id">
            <input type="submit" value="Update admin" name="submit">
          </tr>
        </table>
      </form>
    </div>
  </div>
<?php include('partials/footer.php'); ?>

<?php
  if(isset($_POST['submit'])){
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=$_POST['id'];

    $sql="UPDATE tbl_admin SET 
      full_name='$full_name',
      username='$username'
      WHERE id=$id
    ";

    // Executing query and saving in database
    
    $result=mysqli_query($conn,$sql) or die(mysql_error);
    
    if($result){
      $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
      header('location:'.SITE_URL.'admin/manage-admin.php');
    }else{
      $_SESSION['update']="<div class='error'>Failed to update admin</div>";
      header('location:'.SITE_URL.'admin/manage-admin.php');
    }
  }
?>