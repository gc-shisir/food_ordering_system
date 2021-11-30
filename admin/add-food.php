<?php include('partials/header.php'); 
      include('partials/menu.php'); 

      if(isset($_POST['submit'])){
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];

        if(isset($_POST['featured'])){
          $featured=$_POST['featured'];
        }else{
          $featured='No';
        }
        
        if(isset($_POST['active'])){
          $active=$_POST['active'];
        }else{
          $active='No';
        }

        // check if select button is clicked or not for uploading image
        if(isset($_FILES['image']['name'])){
          $image_name=$_FILES['image']['name'];
          // check if image is selected or not
          if($image_name!=''){
            $ext=end(explode('.',$image_name));
            $image_name='Food-Name-'.rand(0000,9999).'.'.$ext;
            $src=$_FILES['image']['tmp_name'];
            $dst='../images/food/'.$image_name;
            echo $src.','.$dst;
            $upload=move_uploaded_file($src,$dst);
            if(!$upload){
              $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
              header('location:'.SITE_URL."admin/add-food.php");
              die();
            }

          }
        }else{
          $image_name='';
        }

        $sql2="INSERT INTO tbl_food SET
          title='$title',
          description='$description',
          price=$price,
          image_name='$image_name',
          category_id=$category,
          featured='$featured',
          active='$active'
          ";

        $res2=mysqli_query($conn,$sql2);
        if($res2){
          $_SESSION['add']="<div class='success'>Food added successfully</div>";
          header("location:".SITE_URL.'admin/manage-food.php');
        }else{
          $_SESSION['add']="<div class='error'>Failed to add food</div>";
          header("location:".SITE_URL.'admin/manage-food.php');
        }
      }
  ?>
  <div class="main-content">
    <div class="wrapper">
      <h1>Add food</h1><br><br>
      <?php if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
      } ?>
      <form action="" method='POST' enctype='multipart/form-data'>
        <table class="tbl-30">
          <tr>
            <td>Title:</td>
            <td><input type="text" name="title" id="title" placeholder='Title of food'></td>
          </tr>
          <tr>
            <td>Description</td>
            <td><textarea name="description" id="" placeholder='Description of the food' cols="30" rows="10"></textarea></td>
          </tr>
          <tr>
            <td>Price:</td>
            <td><input type="number" name="price" id="price"></td>
          </tr>
          <tr>
            <td>Select Image:</td>
            <td><input type="file" name="image" id=""></td>
          </tr>
          <tr>
            <td>Category:</td>
            <td><select name="category" id="">
                  <?php 
                    // Code to display categories from database
                    $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    if($count>0){
                      while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        ?>
                          <option value="<?php echo $id; ?>"><?php echo $title; ?> </option>
                        <?php
                      }
                    }else{
                      ?>
                      <option value="0">No categories available</option>
                      <?php
                    }
                  ?>
                </select>
            </td>
          </tr>
          <tr>
            <td>Featured</td>
            <td><input type="radio" value="Yes" id="">Yes
                <input type="radio" value="No" id="">No
            </td>
          </tr>
          <tr>
            <td>Active:</td>
            <td><input type="radio" value="Yes" id="">Yes
                <input type="radio" value="No" id="">No</td>
          </tr>
          <tr>
            <td colspan='2'>
              <input type="submit" value="Add Food" name='submit' class='btn-secondary'>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
<?php include('partials/footer.php'); ?>