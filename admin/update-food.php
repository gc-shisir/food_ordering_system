<!-- update 26:48 -->

<?php include('./partials/header.php'); ?>
<?php include('./partials/menu.php'); ?>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM tbl_food WHERE id = $id";
        $res2 = mysqli_query($conn, $sql2);
        $row2=mysqli_fetch_assoc($res2);
        $title=$row2['title'];
        $description=$row2['description'];
        $price=$row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];
    }else{
        header('location:'.SITE_URL.'admin/manage_food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>
        <br><br>

        <form action="" method='POST' enctype='multipart/form-data'>
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" id="" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" id="" cols="30" rows="5" value="<?php echo $description; ?>"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" id="" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image==''){
                                echo "<div class='error'>Image not Available</div>";
                            }else{
                               ?>
                                <img src="<?php echo SITE_URL.'images/food/'.$current_image; ?>" alt="" width="100">
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td><input type="file" name="image" id=""></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                    <select name="category" id="">
                        <?php 
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            $res=mysqli_query($conn,$sql);
                            $count=mysqli_num_rows($res);
                            if($count>0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $category_id=$row['id'];
                                    $category_title=$row['title'];
                                    ?>
                                    <option value="<?php echo $category_id; ?>" <?php if($category_id==$current_category){echo "selected";} ?>><?php echo $category_title; ?></option>
                                    <?php
                                    echo "<option value='$category_id'>$category_title</option>";
                                }
                            }else{
                                echo "<option value='0'>No Category Available</option>";
                            }
                         ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value='Yes' id="">Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value='No' id="">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value='Yes' id="">Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value='No' id="">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" value="Update Food" name='submit' class='btn-secondary'>
                    </td>
                </tr>
            </table>
        </form>

        <!-- update the food -->
        <?php 
            if(isset($_POST['submit'])){
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];

                $featured=$_POST['featured'];
                $active=$_POST['active'];

                // check whether upload button is cliked or not for uploading images
                if(isset($_FILES['image']['name'])){
                    $image_name=$_FILES['image']['name'];
                    if($image_name!=''){
                        $ext=end(explode('.',$image_name));
                        $image_name="Food-Name-".rand(0000,9999).'.'.$ext;
                        $src_path=$_FILES['image']['tmp_name'];
                        $dest_path="../images/food/".$image_name;
                        $upload=move_uploaded_file($src_path,$dest_path);

                        if($upload==false){
                            $_SESSION['upload']="<div class='error'>Failed to upload new image</div>";
                            header('location:'.SITE_URL.'admin/manage_food.php');
                            
                            // Stop the process since image is not uploaded to prevent update to database
                            die();
                        }

                        // remove current image if availble
                        if($current_image!=''){
                            $remove_path="../images/food/".$current_image;
                            $remove=unlink($remove_path);

                            if($remove==false){
                                $_SESSION['remove-failed']="<div class='error'>Failed to remove Image</div>";
                                header('location:'.SITE_URL.'admin/manage_food.php');
                                // stop the process since image is not removed from folder
                                die();
                            }
                        }

                }
                else{
                    $image_name=$current_image;
                    $sql3="UPDATE tbl_food
                    SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id";

                    $res3=mysqli_query($conn,$sql3);
                    if(res3){
                        $_SESSION['update']="<div class='success'>Food Updated Successfully</div>";
                        header('location:'.SITE_URL.'admin/manage_food.php');
                    }else{
                        $_SESSION['update']="<div class='error'>Failed to Update Food</div>";
                        header('location:'.SITE_URL.'admin/manage_food.php'); 
                    }
                }
            }
        }
        ?>
    </div>
</div>

<?php include('./partials/footer.php'); ?>