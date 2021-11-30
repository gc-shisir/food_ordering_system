<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
  <div class="login">
    <h1 class="text-center" style="margin-top:4%;">
      Login
    </h1>
    <?php 
      if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);
      }
      if(isset($_SESSION['user-not-logged-in'])){
        echo $_SESSION['user-not-logged-in'];
        unset($_SESSION['user-not-logged-in']);
      }
    ?>
    <!-- Login form starts here -->
      <form action="" method="POST" class="text-center">
        Username: <br>
        <input type="text" name="username" id="" placeholder="Enter username"><br><br>
        Password: <br>
        <input type="password" name="password" id="" placeholder="Enter password"><br><br>
        <input type="submit" value="Login" class="btn-primary" name='submit' style="width:20%;">
      </form>
    <!-- Login form ends here -->
  </div>
</body>
</html>

<?php 
  if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    echo $password;

   $query="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

   $result=mysqli_query($conn,$query);
    if($result){
      $count=mysqli_num_rows($result);
      if($count==1){
        echo "passed";
        $_SESSION['login']="<div class=\"success \">Login Successful</div>";
        $_SESSION['user']=$username;
        header('location:'.SITE_URL.'admin/');
      }else{
        echo "Failed";
        $_SESSION['login']="<div class='error text-center'>Either username or password didnot match</div>";
        header('location:'.SITE_URL.'admin/login.php');
      }
    }else{
      echo "failed";
    }
  }

?>