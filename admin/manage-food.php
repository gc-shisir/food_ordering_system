<?php include('./partials/header.php'); ?>

<!-- Navbar section -->
<?php include('./partials/menu.php'); ?>

<!-- Main content section -->
<div class="main-content">
  <div class="wrapper">
    <h2>Manage Food</h2>
    <br>
    <!-- Begin add food section -->
    <a href="<?php echo SITE_URL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
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
      if(isset($_SESSION['unauthorize'])){
        echo $_SESSION['unauthorize'];
        unset($_SESSION['unauthorize']);
      }
      if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
      }
      if(isset($_SESSION['error'])){ 
        echo $_SESSION['error'];
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['update'])){ 
        echo $_SESSION['update'];
        unset($_SESSION['update']);
      }
      
    ?>
    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>

      <?php
        $sql='SELECT * FROM tbl_food';
        $result=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($result);
        $sn=1;
        if($count>0){
          while($row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
            // echo $image_name;
            $featured=$row['featured'];
            $active=$row['active'];
            ?>
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $price; ?></td>
                <td>
                  <?php $image_name!='' ? print "<img width='100px' height='100px' src=".SITE_URL.'images/food/'.$image_name.">" 
                    : print "No image available" ?>  
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                  <a href="<?php echo SITE_URL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                  <a href="<?php echo SITE_URL;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete </a>
                </td>
              </tr>
              
            <?php
          }
        }else{
          echo "<tr><td colspan='7' class='error'>Food not added</td></tr>";
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
  
