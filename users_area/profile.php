<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce Website</title>
  <!-- bootsrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--CSS link-->
  <link rel="stylesheet" href="../styles.css">
  <style>
    .profile_image{
    width: 90%;
    margin: auto;
    display: block;
    object-fit: contain;
  }
  body{
    overflow-x:hidden;
  }
  .edit_image{
    width: 100px;
    height: 100px;
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
        <img src="../images/logo.avif" alt="ecom-logo" class="logo">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../display_all.php">Products</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="profile.php">My Account</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="admin_area/index.php">Admin panel(TEST)</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../cart.php">
                <i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_num();?></sup></a>
            </li>

          



          </ul>

          <form class="d-flex" action="../search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
            <!--<button class="btn btn-outline-light" type="submit">Search</button> -->
            <input type="submit" value="search" class="btn btn-outline-light" name="search_data_product">
          </form>

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
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
        }
        else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a></li>";
          
        }
        
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='user_login.php'>Log in</a>
        </li>";
        }
        else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='logout.php'>Log out</a>
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
    
    <div class="row p-4 bg-light">
      <div class="col-md-2 col-sm-4 p-0">
        <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
          <li class="nav-item bg-info">
              <a class="nav-link text-light" href="profile.php"><h4>Your profile</h4></a>
          </li>

          <?php
          $user_name=$_SESSION['username'];
          $user_image="select * from `users` where user_name='$user_name'";
          $result_image=mysqli_query($con,$user_image);
          $row_image=mysqli_fetch_array($result_image);
          $user_image=$row_image['user_image'];

          echo "<li class='nav-item bg-info'>
              <img src='./users_images/$user_image' class='profile_image' alt='image'>
          </li>";
          ?>

          <li class="nav-item">
              <a class="nav-link text-light" href="profile.php">Pending Orders</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light" href="profile.php?log_out">Log Out</a>
          </li>
        </ul>
      </div>
      <div class="col-md-10 col-sm-8 p-0 text-center">
        <?php
        get_user_order_details();
        if(isset($_GET['edit_account'])){
          include('edit_account.php');
        }
        if(isset($_GET['my_orders'])){
          include('my_orders.php');
        }
        if(isset($_GET['delete_account'])){
          include('delete_account.php');
        }
        ?>
      </div>
      
    </div>

    <!--last child-->
    <!--include footer-->
    <?php
    include("../includes/footer.php")
    ?>
  
  </div>

  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>