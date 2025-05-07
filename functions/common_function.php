<?php
//including connect file
include('./includes/connect.php');

//getting product
function getproducts()
{
  global $con;

  //condition to check if isset or not
  if (!isset($_GET['category'])) {
    if (!isset($_GET['brand'])) {

      $select_query = "select * from `products` order by rand() limit 0,9";
      $result_query = mysqli_query($con, $select_query);
      //$row=mysqli_fetch_assoc($result_query);
      //echo $row['product_title'];
      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image1'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        $product_price = $row['product_price'];

        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <a href='#' class='btn btn-primary'>Add to cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
            </div>
        </div>
      </div>";
      }
    }
  }
}

//getting unique catagories product
function get_unique_categories()
{
  global $con;

  //condition to check if isset or not
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $select_query = "select * from `products` where category_id=$category_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    //checking if no product for the category
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
    }
    //$row=mysqli_fetch_assoc($result_query);
    //echo $row['product_title'];
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image = $row['product_image1'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      $product_price = $row['product_price'];

      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
        <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
          <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <a href='#' class='btn btn-primary'>Go somewhere</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
          </div>
      </div>
    </div>";
    }
  }
}

//getting unique brands product
function get_unique_brands()
{
  global $con;

  //condition to check if isset or not
  if (isset($_GET['brand'])) {
    $brand_id = $_GET['brand'];
    $select_query = "select * from `products` where brand_id=$brand_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    //checking if no product for the brand
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No stock for this brand'</h2>";
    }
    //$row=mysqli_fetch_assoc($result_query);
    //echo $row['product_title'];
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image = $row['product_image1'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      $product_price = $row['product_price'];

      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
        <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
          <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <a href='#' class='btn btn-primary'>Go somewhere</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
          </div>
      </div>
    </div>";
    }
  }
}



//getting brands
function getbrands()
{
  global $con;
  $select_brands = "select * from `brands`";
  $result_brands = mysqli_query($con, $select_brands);
  //$row_data=mysqli_fetch_assoc($result_brands);
  //echo $row_data['brand_title'];
  while ($row_data = mysqli_fetch_assoc($result_brands)) {
    $brand_title = $row_data['brand_title'];
    $brand_id = $row_data['brand_id'];
    echo "<li class='nav-item border border-dark'>
          <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
        </li>";
  }
}

//getting categories
function getcategories()
{
  global $con;
  $select_categories = "select * from `categories`";
  $result_categories = mysqli_query($con, $select_categories);
  //$row_data=mysqli_fetch_assoc($result_categories);
  //echo $row_data['category_title'];
  while ($row_data = mysqli_fetch_assoc($result_categories)) {
    $category_title = $row_data['category_title'];
    $category_id = $row_data['category_id'];
    echo "<li class='nav-item border border-dark'>
          <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
        </li>";
  }
}

//searching product function
function search_product()
{
  global $con;
  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];

    $search_query = "select * from `products` where product_keywords like '%$search_data_value%'";
    $result_query = mysqli_query($con, $search_query);

    //$row=mysqli_fetch_assoc($result_query);
    //echo $row['product_title'];

    //checking if no product available in search

    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No product available for this search</h2>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image = $row['product_image1'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      $product_price = $row['product_price'];

      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
        <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
          <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <a href='#' class='btn btn-primary'>Go somewhere</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
          </div>
      </div>
    </div>";
    }
  }
}

//getting product
function get_all_products()
{
  global $con;

  //condition to check if isset or not
  if (!isset($_GET['category'])) {
    if (!isset($_GET['brand'])) {

      $select_query = "select * from `products` order by rand()";
      $result_query = mysqli_query($con, $select_query);
      //$row=mysqli_fetch_assoc($result_query);
      //echo $row['product_title'];
      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image1'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        $product_price = $row['product_price'];

        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <a href='#' class='btn btn-primary'>Go somewhere</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
            </div>
        </div>
      </div>";
      }
    }
  }
}

//view details function
function view_details()
{
  global $con;

  //condition to check if isset or not
  if (isset($_GET['product_id'])) {
    if (!isset($_GET['category'])) {
      if (!isset($_GET['brand'])) {
        $product_id = $_GET['product_id'];
        $select_query = "select * from `products` where product_id=$product_id";
        $result_query = mysqli_query($con, $select_query);
        //$row=mysqli_fetch_assoc($result_query);
        //echo $row['product_title'];
        while ($row = mysqli_fetch_assoc($result_query)) {
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_image2 = $row['product_image2'];
          $product_image3 = $row['product_image3'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];
          $product_price = $row['product_price'];

          echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img class='card-img-top' src='./admin_area/product_images/$product_image1' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <a href='#' class='btn btn-primary'>Go somewhere</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
            </div>
        </div>
      </div>
      <div class='col-md-8'>
      
                        <div class='row'>
                            <div class='col-md-12'>
                                <h4 class='text-center text-info mb-5'>Related products</h4>
                            </div>
                            <div class='col-md-6'><img class='card-img-top' src='./admin_area/product_images/$product_image2' alt='$product_title'></div>
                            <div class='col-md-6'><img class='card-img-top' src='./admin_area/product_images/$product_image3' alt='$product_title'></div>
                        </div>

                    </div>";
        }
      }
    }
  }
}
