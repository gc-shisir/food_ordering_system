<?php include('./partials/header.php'); ?>

<!-- Navbar section -->
<?php include('./partials/menu.php'); ?>

<!-- Main content section -->
<div class="main-content">
  <div class="wrapper">
    <h1>Dashboard</h1>
    <?php 
    if(isset($_SESSION['login'])){
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
  ?>
    <div class="col-4 text-center">
      <h1>5</h1>
      Categories
    </div>
    <div class="col-4 text-center">
      <h1>5</h1>
      Categories
    </div>
    <div class="col-4 text-center">
      <h1>5</h1>
      Categories
    </div>
    <div class="col-4 text-center">
      <h1>5</h1>
      Categories
    </div>
    <div class="clearfix"></div>
  </div>
  
</div>

<!-- Footer Section -->
<div class="footer">
  <div class="wrapper">
    <p class="text-center">2020 All rights Reserved. Developed By : <a href="#">Shisir G.C.</a></p>
  </div>
</div>
  
<?php  include('./partials/footer.php'); ?>
  
