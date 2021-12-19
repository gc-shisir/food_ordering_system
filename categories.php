<?php include('./partials/header.php'); ?>
<?php include('./config/constants.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                            <a href="category-foods.html">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name==''){
                                            echo "<div class='error'>Image Not Found</div>";
                                        }else{
                                            ?>
                                                <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                     ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>        
                        <?php
                    }
                }else{
                    echo "<div class='error'>Category Not Found</div>";
                }
            ?>    

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <?php include('./partials/footer.php'); ?>