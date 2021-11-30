<?php include('partials/header.php'); ?>
<!-- Navbar section -->
<?php include('./partials/menu.php'); ?>

  <div class="main-content">
    <div class="wrapper">
      <h2>Add Admin</h2>
      <br>
      <?php 
        if(isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }
      ?>
      <br>
      <form action="" method="POST">
        <table>
          <tr>
            <td>Full Name</td>
            <td><input type="text" name="full_name" placeholder="Enter your name"></td>
          </tr>
          <tr>
            <td>Username</td>
            <td><input type="text" name="username" placeholder="Enter your username"></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input type="password" name="password" placeholder="Enter your password"></td>
          </tr>
          <tr colspan="2">
            <input type="submit" value="Add admin" name="submit">
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
    $password=md5($_POST['password']); //hashing password with md5

    $sql="INSERT INTO tbl_admin SET 
      full_name='$full_name',
      username='$username',
      password='$password'
    ";

    // Executing query and saving in database
    
    $result=mysqli_query($conn,$sql) or die(mysql_error);
    
    if($result){
      $_SESSION['add']="<div class='success'>Admin added successfully</div>";
      header('location:'.SITE_URL.'admin/manage-admin.php');
    }else{
      $_SESSION['add']="<div class='error'>Failed to add admin</div>";
      header('location:'.SITE_URL.'admin/add-admin.php');
    }
  }
?>