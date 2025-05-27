<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

// Redirect if admin not logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_name = $_SESSION['admin_name'];

// Fetch admin details
$get_admin = "SELECT * FROM admins WHERE admin_name = ?";
$stmt = $con->prepare($get_admin);
$stmt->bind_param("s", $admin_name);
$stmt->execute();
$result = $stmt->get_result();
$admin_data = $result->fetch_assoc();
$admin_image = $admin_data['admin_image'] ?? 'default.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .product_images { width: 8vw; object-fit: contain; }
        .admin_image { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
        .button a { display: block; padding: 10px; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/logo.avif" alt="Logo" class="logo">
                <span class="navbar-text text-white ms-auto">
                    Welcome, <?= htmlspecialchars($admin_name) ?>
                </span>
            </div>
        </nav>

        <!-- Admin controls -->
        <div class="row g-0">
            <div class="col-md-2 bg-secondary text-white p-3 text-center">
                <img src="../admin_images/<?= htmlspecialchars($admin_image) ?>" alt="Admin" class="admin_image mb-2">
                <h6><?= htmlspecialchars($admin_name) ?></h6>

                <!-- Navigation -->
                 <!-- Homepage Button -->
                <a href="index.php" class="bg-dark text-white d-block mt-3"><i class="fa-solid fa-house"></i> Admin Dash</a>
                <div class="button">
                    <a href="index.php?insert_product" class="bg-info text-white">Insert Products</a>
                    <a href="index.php?view_products" class="bg-info text-white">View Products</a>
                    <a href="index.php?insert_category" class="bg-info text-white">Insert Categories</a>
                    <a href="index.php?view_categories" class="bg-info text-white">View Categories</a>
                    <a href="index.php?insert_brand" class="bg-info text-white">Insert Brands</a>
                    <a href="index.php?view_brands" class="bg-info text-white">View Brands</a>
                    <a href="index.php?all_orders" class="bg-info text-white">All Orders</a>
                    <a href="index.php?all_payments" class="bg-info text-white">All Payments</a>
                    <a href="index.php?list_users" class="bg-info text-white">List Users</a>
                    <a href="admin_logout.php" class="bg-danger text-white">Logout</a>
                </div>

                
            </div>

            <!-- Dynamic content loader -->
            <div class="col-md-10 p-4">
                <?php
                if (isset($_GET['insert_category'])) include('insert_categories.php');
                elseif (isset($_GET['insert_brand'])) include('insert_brands.php');
                elseif (isset($_GET['insert_product'])) include('insert_product.php');
                elseif (isset($_GET['view_products'])) include('view_products.php');
                elseif (isset($_GET['edit_product'])) include('edit_product.php');
                elseif (isset($_GET['delete_product'])) include('delete_product.php');
                elseif (isset($_GET['view_categories'])) include('view_categories.php');
                elseif (isset($_GET['edit_category'])) include('edit_category.php');
                elseif (isset($_GET['delete_category'])) include('delete_category.php');
                elseif (isset($_GET['view_brands'])) include('view_brands.php');
                elseif (isset($_GET['delete_brand'])) include('delete_brand.php');
                elseif (isset($_GET['all_orders'])) include('all_orders.php');
                elseif (isset($_GET['all_payments'])) include('all_payments.php');
                elseif (isset($_GET['list_users'])) include('list_users.php');
                else echo "<h4 class='text-center'>Welcome to Admin Dashboard</h4>";
                ?>
            </div>
        </div>

        <!-- Footer -->
        <?php include("../includes/footer.php"); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
