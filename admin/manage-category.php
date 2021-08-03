<?php include('./partials/header.php'); ?>

<!-- Navbar section -->
<?php include('./partials/menu.php'); ?>

<!-- Main content section -->
<div class="main-content">
  <div class="wrapper">
    <h2>Manage Category</h2>
    <br>
    <?php 
        if(isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove'])){
          echo $_SESSION['remove'];
          unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found'])){
          echo $_SESSION['no-category-found'];
          unset($_SESSION['no-category-found']);
        }
        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-to-remove'])){
          echo $_SESSION['failed-to-remove'];
          unset($_SESSION['failed-to-remove']);
        }
      ?><br>
    <!-- Begin add Category section -->
    <a href="<?php echo SITE_URL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
    <br><br>
    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
      <?php 
        $sql="SELECT * FROM tbl_category";
        $result=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($result);
        if($count>0){
          $sn=0;
          while($row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $title=$row['title'];
            $image_name=$row['image_name'];
            $featured=$row['featured'];
            $active=$row['active'];

            ?>
              <tr>
                <td><?php echo ++$sn ?></td>
                <td><?php echo $title ?></td>
                <td>
                  <?php $image_name!='' ? print "<img width='80px' src=".SITE_URL.'images/category/'.$image_name.">" 
                    : print "No image available" ?>
                </td>
                <td><?php echo $featured ?></td>
                <td><?php echo $active ?></td>
                <td>
                  <a href="<?php echo SITE_URL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                  <a href="<?php echo SITE_URL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                </td>
              </tr>
            <?php
          }
        }else{
          "<tr><td colspan='6'><div class='error'>No Category Found</div></td></tr>";
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
  
