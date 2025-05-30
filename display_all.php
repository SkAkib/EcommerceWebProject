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
  <title>Ecommerce Website</title>
  <!-- bootsrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--CSS link-->
  <link rel="stylesheet" href="styles.css">
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
                <i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_num();?></sup></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Total Price</a>
            </li>



          </ul>

          <form class="d-flex" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
            <!--<button class="btn btn-outline-light" type="submit">Search</button> -->
            <input type="submit" value="search" class="btn btn-outline-light" name="search_data_product">
          </form>

        </div>
      </div>
    </nav>

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
          <a class='nav-link' href='./users_area/user_login.php'>Log in</a>
        </li>";
        }
        else{
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
    <div class="row">
      <div class="col-md-10">

        <!--Products-->
        <div class="row">
          <!--fetching query-->
          <?php

          //calling getproduct function
          get_all_products();
          get_unique_categories();
          get_unique_brands()

          /*
    $select_query="select * from `products` order by rand() limit 0,9"; 
    $result_query=mysqli_query($con,$select_query);
    //$row=mysqli_fetch_assoc($result_query);
    //echo $row['product_title'];
    while($row=mysqli_fetch_assoc($result_query)){
      $product_id=$row['product_id'];
      $product_title=$row['product_title'];
      $product_description=$row['product_description'];
      $product_image=$row['product_image1'];
      $category_id=$row['category_id'];
      $brand_id=$row['brand_id'];
      $product_price=$row['product_price'];

      echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <a href='#' class='btn btn-primary'>Go somewhere</a>
            </div>
        </div>
      </div>";
      
    }
    */
          ?>
          <!--
      <div class="col-md-4 mb-2">
        <div class="card">
          <img class="card-img-top" src="./images/banana.jpeg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
      </div> -->

        </div>
      </div>
      <div class="col-md-2 bg-secondary p-0">
        <!--Side nav-->
        <!--Brands to be displayed-->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item">
            <a href="" class="nav link text-light">
              <h4>Delivery Brands</h4>
            </a>
          </li>

          <?php
          //calling getbrand func
          getbrands();
          /*
        $select_brands="select * from `brands`";
        $result_brands=mysqli_query($con,$select_brands);
        //$row_data=mysqli_fetch_assoc($result_brands);
        //echo $row_data['brand_title'];
        while($row_data=mysqli_fetch_assoc($result_brands)){
          $brand_title=$row_data['brand_title'];
          $brand_id=$row_data['brand_id'];
          echo "<li class='nav-item border border-dark'>
          <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
        </li>";
        }
        */
          ?>

          <!--Catagories to be displayed-->
          <ul class="navbar-nav text-center">
            <li class="nav-item">
              <a href="" class="nav link text-light">
                <h4>Catagories</h4>
              </a>
            </li>

            <?php
            //calling getcategories function
            getcategories();
            /*
        $select_categories="select * from `categories`";
        $result_categories=mysqli_query($con,$select_categories);
        //$row_data=mysqli_fetch_assoc($result_categories);
        //echo $row_data['category_title'];
        while($row_data=mysqli_fetch_assoc($result_categories)){
          $category_title=$row_data['category_title'];
          $category_id=$row_data['category_id'];
          echo "<li class='nav-item border border-dark'>
          <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
        </li>";
        }
        */
            ?>

          </ul>
      </div>

    </div>

    <!--last child-->
    <div class="bg-info p-3 text-center">
      <P>All rights resereved ,Copyright 2022</P>
    </div>


  </div>





  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>