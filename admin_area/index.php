<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--css file-->
    <link rel="stylesheet" href="../styles.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/logo.avif" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">       
                <ul class="navbar-nav">
                    <li class="nav-link">
                        <a href="" class="nav-link">Welcome</a>
                    </li>
                </ul>
            </div>
                </nav>
            </div>
        </nav>
        <!--second child-->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage details</h3>
        </div>

        <!--third child-->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="px-3">
                    <a href="#"><img src="../images/mango.jpg" alt="" class="admin_image m-2"></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>
                <div class="button text-center container-fluid">
        <!--button*10>a.nav-link.text-light.bg-info.my-1-->
                    
                    <button class="my-1"><a href="" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                    
                    <button class="my-1"><a href="" class="nav-link text-light bg-info my-1">View Products</a></button>

                    <button class="my-1"><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>

                    <button class="my-1"><a href="" class="nav-link text-light bg-info my-1">View Categories</a></button>

                    <button class="my-1"><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brands</a></button>

                    <button class="my-1"><a href="" class="nav-link text-light bg-info my-1">View Brands</a></button>

                    <button class="my-1"><a href="" class="nav-link text-light bg-info my-1">All Orders</a></button>

                    <button class="my-1"><a href="" class="nav-link text-light bg-info my-1">All Payments</a></button>

                    <button class="my-1"><a href="" class="nav-link text-light bg-info my-1">List Users</a></button>

                    <button class="my-1"><a href="" class="nav-link text-light bg-info my-1">Logout</a></button>
                </div>
            </div>
        </div>
        <!--go back home button-->
        <button class="my-1"><a href="../index.php" class="nav-link text-light bg-info my-1 px-2"><i class="fa-solid fa-house"></i>Go to Homepage</a></button>

        <!--Fourth child-->
        <div class="container my-3">
            <?php
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brand'])){
                include('insert_brands.php');
            }
            ?>
        </div>
    </div>






        <!--last child-->
        <div class="bg-info p-3 text-center footer">
        <P>All rights resereved ,Copyright 2022</P> 
        </div>

<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>