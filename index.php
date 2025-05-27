<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Store | Home</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <!-- Navbar -->
  <div class="container-fluid p-0">
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg bg-info navbar-light">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand">
          <img src="./images/logo.avif" alt="ecom-logo" class="logo" style="height: 50px; width:fit-content;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
            <?php if (!isset($_SESSION['username'])): ?>
              <li class="nav-item"><a class="nav-link" href="./users_area/user_reg.php">Register</a></li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="./users_area/profile.php">My Account</a></li>
            <?php endif; ?>
            
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="admin_area/admin_login.php">Admin Panel</a></li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
                <sup><?= cart_item_num(); ?></sup>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Total: ৳<?= total_cart_price(); ?></a>
            </li>
          </ul>

          <!-- Dark Mode Toggle -->
          <div class="form-check form-switch ms-3">
            <input class="form-check-input" type="checkbox" id="darkModeToggle">
            <label class="form-check-label text-white" for="darkModeToggle">Dark Mode</label>
          </div>

          <form class="d-flex" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" name="search_data" placeholder="Search">
            <input class="btn btn-outline-light" type="submit" name="search_data_product" value="Search">
          </form>
        </div>
      </div>
    </nav>

    <!-- Welcome Message + Login Status -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary px-3">
      <ul class="navbar-nav me-auto">
        <?php if (!isset($_SESSION['username'])): ?>
          <li class="nav-item"><a class="nav-link" href="#">Welcome Guest</a></li>
          <li class="nav-item"><a class="nav-link" href="./users_area/user_login.php">Log in</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="./users_area/profile.php">Welcome <?= $_SESSION['username']; ?></a></li>
          <li class="nav-item"><a class="nav-link" href="./users_area/logout.php">Log out</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    <!-- Main Content Header -->
    <div class="bg-light py-3 text-center">
      <h3 class="fw-bold">My Store</h3>
      <p class="text-muted mb-0">One-stop solution to all your needs</p>
    </div>

    <!-- Content Section -->
    <div class="row">
      <!-- Product Section -->
      <div class="col-md-10">
        <div class="row p-3">
          <?php
          getproducts();
          get_unique_categories();
          get_unique_brands();
          ?>
        </div>
      </div>

      <!-- Sidebar Section -->
      <div class="col-md-2 bg-secondary p-3">
        <!-- Brands -->
        <h4 class="text-center text-light">Delivery Brands</h4>
        <ul class="navbar-nav text-center">
          <?php getbrands(); ?>
        </ul>

        <!-- Categories -->
        <h4 class="text-center text-light mt-4">Categories</h4>
        <ul class="navbar-nav text-center">
          <?php getcategories(); ?>
        </ul>
      </div>
    </div>

    <!-- Footer -->
    <?php include("includes/footer.php"); ?>
  </div>
  <!--toggle dark mode JS-->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggleSwitch = document.getElementById('darkModeToggle');
      const currentTheme = localStorage.getItem('theme');

      if (currentTheme === 'dark') {
        document.body.classList.add('dark-mode');
        toggleSwitch.checked = true;
      }

      toggleSwitch.addEventListener('change', function() {
        if (this.checked) {
          document.body.classList.add('dark-mode');
          localStorage.setItem('theme', 'dark');
        } else {
          document.body.classList.remove('dark-mode');
          localStorage.setItem('theme', 'light');
        }
      });
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>