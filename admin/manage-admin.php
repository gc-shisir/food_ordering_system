<?php include('./partials/header.php'); ?>

<!-- Navbar section -->
<?php include('./partials/menu.php'); ?>

<!-- Main content section -->
<div class="main-content">
  <div class="wrapper">
    <h2>Manage admin</h2>
    <br>
    <!-- Begin add admin section -->
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br><br>
    <?php 
      if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }

      if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
      }

      if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
      }

      if(isset($_SESSION['pwd-change'])){
        echo $_SESSION['pwd-change'];
        unset($_SESSION['pwd-change']);
      }

      if(isset($_SESSION['pwd-not-match'])){
        echo $_SESSION['pwd-not-match'];
        unset($_SESSION['pwd-not-match']);
      }

      if(isset($_SESSION['user-not-found'])){
        echo $_SESSION['user-not-found'];
        unset($_SESSION['user-not-found']);
      }
    ?>
    <br><br>
    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>
      <?php
        $sql='SELECT * FROM tbl_admin';
        $result=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($result);
        if($count>0){
          $sn=1;
          while($row=mysqli_fetch_assoc($result)){
            ?>
              <tr>
                <td><?php echo $sn++ ; ?></td>
                <td><?php echo $row['full_name'] ?></td>
                <td><?php echo  $row['username'] ?></td>
                <td>
                  <a href="<?php echo SITE_URL; ?>admin/update-password.php?id=<?php echo $row['id']; ?>" class="btn-primary">Change Password</a>
                  <a href="<?php echo SITE_URL; ?>admin/update-admin.php?id=<?php echo $row['id']; ?>" class="btn-secondary">Update</a>
                  <a href="<?php echo SITE_URL; ?>admin/delete-admin.php?id=<?php echo $row['id']; ?>" class="btn-danger">Delete</a>
                </td>
              </tr>
            <?php 
          }
        }
      ?>
      
    </table>
  </div>
</div>

<!-- Footer Section -->
<div class="footer">
  <div class="wrapper">
    <p class="text-center">2020 All rights Reserved. Developed By : <a href="#">Shisir G.C.</a></p>
  </div>
</div>
  
<?php  include('./partials/footer.php'); ?>
  
