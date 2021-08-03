<?php include('partials/header.php'); ?>
<!-- Navbar section -->
<?php include('./partials/menu.php'); ?>

<?php 
  if(isset($_GET['id'])){
    $id=$_GET['id'];
  }else{
    header('location:'.SITE_URL.'admin/manage-admin.php');
  }
?>

  <div class="main-content">
    <div class="wrapper">
      <h2>Add Admin</h2>
      <br>
      <br>
      <form action="" method="POST">
        <table>
          <tr>
            <td>Current Password</td>
            <td><input type="password" name="current_password" placeholder="Current password"></td>
          </tr>
          <tr>
            <td>New Password</td>
            <td><input type="password" name="new_password" placeholder="New password"></td>
          </tr>
          <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
          </tr>
          <tr colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
            <input type="submit" value="Add admin" name="submit">
          </tr>
        </table>
      </form>
    </div>
  </div>
<?php include('partials/footer.php'); ?>

<?php
  if(isset($_POST['submit'])){
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);
    $password=$_POST['id'];

    $sql="SELECT * FROM tbl_admin WHERE id=$id and password=$current_password";
    $result=mysqli_query($conn,$sql);
    if($result){
      $count=mysqli_num_rows($result);
      if($count==1){
        if($new_password==$confirm_password){
          $sql1="UPDATE tbl_admin SET 
          password='$password' where id=$id";
          $result1=mysqli_query($conn,$sql1);
          if($result1){
            $_SESSION['pwd-change']="<div class='success'>Password changed successfully</div>";
            header('location:'.SITE_URL.'admin/manage-admin.php');
          }else{
            $_SESSION['pwd-change']="<div class='error'>Failed to change password</div>";
            header('location:'.SITE_URL.'admin/manage-admin.php');
          }
        }else{
          $_SESSION['pwd-not-match']="<div class='error'>Password didnot match</div>";
          header('location:'.SITE_URL.'admin/manage-admin.php');
        }
      }
      else{
        $_SESSION['user-not-found']="<div class='error'>Admin not found</div>";
        header('location:'.SITE_URL.'admin/manage-admin.php');
      }
      
    }
  }
?>