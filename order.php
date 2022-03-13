<?php include('./partials/header.php'); ?>
<?php include('./config/constants.php'); ?>

<?php 
     if(isset($_GET['food_id'])){
      $food_id=$_GET['food_id'];
      $sql="SELECT * from tbl_food where id=$food_id";
      $res=mysqli_query($conn,$sql);
      $count=mysqli_num_rows($res);
      if($count){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        // echo $title;
        $image_name=$row['image_name'];
      }else{
        header('location:'.SITE_URL);
      }
     }else{
       header('location:'.SITE_URL);
     }
  ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
      <div class="container">
        <h2 class="text-center text-white">
          Fill this form to confirm your order.
        </h2>

        <form action="" method="POST" class="order">
          <fieldset>
            <legend>Selected Food</legend>

            <div class="food-menu-img">
              <?php 
                if($image_name==''){
                  echo "<div class='error'>Image Not Available</div>";
                }else{
                  ?>
                    <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>" alt="$image_name">
                  <?php
                }
              ?> 
            </div>

            <div class="food-menu-desc">
              <h3><?php echo $title; ?></h3>
              <input type="hidden" name="food" value="<?php echo $title; ?>">
              <p class="food-price">$<?php echo $price; ?></p>
              <input type="hidden" name="price" value="<?php echo $price; ?>">

              <div class="order-label">Quantity</div>
              <input
                type="number"
                name="qty"
                class="input-responsive"
                value="1"
                required
              />
            </div>
          </fieldset>

          <fieldset>
            <legend>Delivery Details</legend>
            <div class="order-label">Full Name</div>
            <input
              type="text"
              name="full-name"
              placeholder="E.g. Shisir GC"
              class="input-responsive"
              required
            />

            <div class="order-label">Phone Number</div>
            <input
              type="tel"
              name="contact"
              placeholder="E.g. 9876xxxxxx"
              class="input-responsive"
              required
            />

            <div class="order-label">Email</div>
            <input
              type="email"
              name="email"
              placeholder="E.g. info@gcshisir.com.np"
              class="input-responsive"
              required
            />

            <div class="order-label">Address</div>
            <textarea
              name="address"
              rows="10"
              placeholder="E.g. Street, City, Country"
              class="input-responsive"
              required
            ></textarea>
            <input 
            type="submit"
              name="submit"
              value="Confirm Order"
              class="btn btn-primary"
            />
          </fieldset>
        </form>
        <?php 
          if(isset($_POST['submit'])){
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty; // total = price x qty 

            $order_date = date("Y-m-d h:i:s"); //Order DAte

            $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];
            $sql2="INSERT INTO tbl_order SET
              food='$food',
              price=$price,
              qty=$qty,
              total=$total,
              order_date='$order_date',
              status='$status',
              customer_name='$customer_name',
              customer_contact='$customer_contact',
              customer_email='$customer_email',
              customer_address='$customer_address'
            ";
            // echo $sql2;die();
            $res2=mysqli_query($conn,$sql2);
            if($res2){
              $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully</div>";
              header('location:'.SITE_URL);
            }else{
              $_SESSION['order']="<div class='error text-center'>Failed to Order Food</div>";
              header('location:'.SITE_URL);
            }
          } 
        ?>
      </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
      <div class="container text-center">
        <ul>
          <li>
            <a href="#"
              ><img
                src="https://img.icons8.com/fluent/50/000000/facebook-new.png"
            /></a>
          </li>
          <li>
            <a href="#"
              ><img
                src="https://img.icons8.com/fluent/48/000000/instagram-new.png"
            /></a>
          </li>
          <li>
            <a href="#"
              ><img src="https://img.icons8.com/fluent/48/000000/twitter.png"
            /></a>
          </li>
        </ul>
      </div>
    </section>
    <!-- social Section Ends Here -->

    <?php include('./partials/footer.php'); ?>