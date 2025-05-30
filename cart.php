<?php
include('includes/connect.php');
include('functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce Website-Cart details</title>
  <!-- bootsrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--CSS link-->
  <link rel="stylesheet" href="styles.css">
  <style>
    .cart_img {
      height: 50px;
      width: 50px;
      object-fit: contain;

    }
  </style>
</head>

<body>
  <!-- navbar -->
  <div class="container-fluid p-0 ">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg bg-info">
      <div class="container-fluid">
        <img src="./images/logo.avif" alt="ecom-logo" class="logo">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="display_all.php">Products</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./users_area/user_reg.php">Register</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="admin_area/index.php">Admin panel(TEST)</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_num(); ?></sup></a>
            </li>
          </ul>

        </div>
      </div>
    </nav>

    <?php
    //calling to cart function
    cart();
    ?>

    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <?php
        if (!isset($_SESSION['username'])) {
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
        } else {
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a></li>";
        }

        if (!isset($_SESSION['username'])) {
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_login.php'>Log in</a>
        </li>";
        } else {
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/logout.php'>Log out</a>
        </li>";
        }
        ?>
      </ul>
    </nav>

    <!--Third child-->
    <div class="bg-light">
      <h3 class="text-center">My store</h3>
      <p class="text-center">Solution to all needs</p>
    </div>

    <!--Fourth child-->
    <div class="container">
      <div class="row">
        <form action="" method="post">
          <table class="table table-bordered text-center">


            <tbody>
              <?php
              global $con;
              $ip_add = get_ip_address();
              $total = 0;

              $cart_query = "select * from `cart_details` where ip_address='$ip_add'";
              $result_query = mysqli_query($con, $cart_query);
              $result_count = mysqli_num_rows($result_query);
              $total = 0;

              if ($result_count > 0) {
                echo "<thead>
    <tr>
      <th>Product Title</th>
      <th>Product Image</th>
      <th>Quantity</th>
      <th>Total Price</th>
      <th>Remove</th>
      <th colspan='2'>Operations</th>
    </tr>
  </thead>";

                while ($row = mysqli_fetch_array($result_query)) {
                  $product_id = $row['product_id'];
                  $quantity = $row['quantity']; // from DB

                  // update quantity if posted
                  if (isset($_POST['update_cart']) && isset($_POST['qty'][$product_id])) {
                    $new_qty = intval($_POST['qty'][$product_id]);
                    if ($new_qty > 0 && $new_qty != $quantity) {
                      $update_cart = "UPDATE `cart_details` SET quantity=$new_qty WHERE ip_address='$ip_add' AND product_id=$product_id";
                      mysqli_query($con, $update_cart);
                      $quantity = $new_qty; // update in memory too
                    }
                  }

                  $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                  $result_products = mysqli_query($con, $select_products);
                  $row_product = mysqli_fetch_assoc($result_products);

                  $product_price = $row_product['product_price'];
                  $product_image = $row_product['product_image1'];
                  $product_title = $row_product['product_title'];
                  $sub_total = $product_price * $quantity;
                  $total += $sub_total;

                  echo "
    <tr>
      <td>$product_title</td>
      <td><img src='./admin_area/product_images/$product_image' class='cart_img'></td>
      <td><input type='number' name='qty[$product_id]' class='form-input w-35 text-center' value='$quantity'></td>
      <td>$sub_total</td>
      <td><input type='checkbox' name='remove_item[]' value='$product_id'></td>
      <td>
        <input type='submit' value='Update Cart' name='update_cart' class='bg-info px-3 border-2 p-1 mx-1'>
        <input type='submit' value='Remove Item' name='remove_cart' class='bg-info px-3 border-2 p-1 mx-1'>
      </td>
    </tr>";
                }
              } else {
                echo "<h2 class='text-center text-danger'>The Cart is empty!</h2>";
              }
              ?>

            </tbody>
          </table>

          <?php
          $ip_add = get_ip_address();


          $cart_query = "select * from `cart_details` where ip_address='$ip_add'";
          $result_query = mysqli_query($con, $cart_query);
          $result_count = mysqli_num_rows($result_query);
          if ($result_count > 0) {
            echo "<div class='d-flex mb-5'>
            <h4 class='px-3'>Subtotal: <strong class='text-info'> $total </strong></h4>
            <input type='submit' value='Continue Shopping' name='continue_shopping' class='bg-info px-3 border-2 p-1 mx-1'>

            <input type='submit' value='Checkout' name='checkout' class='bg-info px-3 border-2 p-1 mx-1' action='./users_area/checkout.php'>
          </div>";
          } else {
            echo "<input type='submit' value='Continue Shopping' name='continue_shopping' class='bg-info px-3 border-2 p-1 mx-1'></input>";
          }
          if (isset($_POST['continue_shopping'])) {
            echo "<script>window.open('index.php','_self')</script>";
          }
          if (isset($_POST['checkout'])) {
            echo "<script>window.open('./users_area/checkout.php','_self')</script>";
          }
          ?>

      </div>
    </div>
    </form>

    <!--function to remove item-->
    <?php
    function remove_cart_item()
    {
      global $con;
      if (isset($_POST['remove_cart']) && isset($_POST['remove_item'])) {
        foreach ($_POST['remove_item'] as $remove_id) {
          $remove_id = intval($remove_id); // sanitizing to prevent SQL injection
          echo $remove_id;
          $delete_query = "delete from `cart_details` where product_id = $remove_id";
          $delete_result = mysqli_query($con, $delete_query);

          if ($delete_result) {
            // Optional: alert per item
            // echo "<script>alert('Item $remove_id removed from cart');</script>";
            echo "<script>window.open('cart.php','_self')</script>";
          }
        }
      }
    }
    remove_cart_item();

    ?>



    <!--last child-->
    <!--include footer-->
    <?php
    include("./includes/footer.php")
    ?>

  </div>

  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>