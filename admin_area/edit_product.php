<?php
//include('../includes/connect.php');

//fetch images to display
if (isset($_GET['edit_product'])) {
    $product_id = $_GET['edit_product'];

    //fetch query
    $fetch_data = "select * from `products` where product_id=$product_id";
    $result_fetch = mysqli_query($con, $fetch_data);
    $row_result_fetch = mysqli_fetch_assoc($result_fetch);
    $disp_product_id = $row_result_fetch['product_id'];
    $disp_product_title = $row_result_fetch['product_title'];
    $disp_product_keywords = $row_result_fetch['product_keywords'];
    $disp_product_description = $row_result_fetch['product_description'];
    $disp_product_image1 = $row_result_fetch['product_image1'];
    $disp_product_image2 = $row_result_fetch['product_image2'];
    $disp_product_image3 = $row_result_fetch['product_image3'];
    $disp_category_id = $row_result_fetch['category_id'];
    $disp_brand_id = $row_result_fetch['brand_id'];
    $disp_product_price = $row_result_fetch['product_price'];
}

//get category name
$get_cat_title = "select * from `categories` where category_id=$disp_category_id";
$result_cat_title = mysqli_query($con, $get_cat_title);
$row_cat = mysqli_fetch_assoc($result_cat_title);
$disp_category_title = $row_cat['category_title'];
//get brand name
$get_brand_title = "select * from `brands` where brand_id=$disp_brand_id";
$result_brand_title = mysqli_query($con, $get_brand_title);
$row_brand = mysqli_fetch_assoc($result_brand_title);
$disp_brand_title = $row_brand['brand_title'];


//////////////////////////////////////////////////////////////////

if (isset($_POST['update_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';
    // Handle image1
    if (!empty($_FILES['product_image1']['name'])) {
        $product_image1 = $_FILES['product_image1']['name'];
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
    } else {
        $product_image1 = $disp_product_image1;
    }

    // Handle image2
    if (!empty($_FILES['product_image2']['name'])) {
        $product_image2 = $_FILES['product_image2']['name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
    } else {
        $product_image2 = $disp_product_image2;
    }

    // Handle image3
    if (!empty($_FILES['product_image3']['name'])) {
        $product_image3 = $_FILES['product_image3']['name'];
        $temp_image3 = $_FILES['product_image3']['tmp_name'];
        move_uploaded_file($temp_image3, "./product_images/$product_image3");
    } else {
        $product_image3 = $disp_product_image3;
    }
    // Update query
    $update_product = "UPDATE `products` SET 
        product_title='$product_title',
        product_description='$product_description',
        product_keywords='$product_keywords',
        category_id='$product_category',
        brand_id='$product_brand',
        product_image1='$product_image1',
        product_image2='$product_image2',
        product_image3='$product_image3',
        product_price='$product_price'
        WHERE product_id=$product_id";

    $result_query = mysqli_query($con, $update_product);

    if ($result_query) {
        echo "<script>alert('Product updated successfully')</script>";
        echo "<script>window.open('index.php?edit_product=$product_id','_self')</script>";
    }
}

//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--css file-->
    <link rel="stylesheet" href="../styles.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-dark">
    <div class="container">
        <h1 class="text-center mt-3">Insert Products</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" value="<?php echo $disp_product_title; ?>" autocomplete="off" required="required">
            </div>

            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" value="<?php echo $disp_product_description; ?>" autocomplete="off" required>
            </div>
            <!--keywords-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" value="<?php echo $disp_product_keywords; ?>" autocomplete="off" required>
            </div>
            <!--categories-->
            <div class="form-outline mb-4 w-50 m-auto">

                <select name="product_category" id="" class="form-select">
                    <option value="<?php echo $disp_category_id; ?>" selected><?php echo $disp_category_title; ?></option>

                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        if ($category_id != $disp_category_id) {
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <!--brands-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brand" id="" class="form-select">
                    <option value="<?php echo $disp_brand_id; ?>" selected><?php echo $disp_brand_title; ?></option>

                    <?php
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        if ($brand_id != $disp_brand_id) {
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    }
                    ?>


                </select>
            </div>
            <!--image 1-->
            <div class="form-outline mb-4 w-50 m-auto d-flex">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" value="<?php echo $disp_product_image1 ?>" autocomplete="off">
                <img class="edit_image" src="./product_images/<?php echo $disp_product_image1 ?>" alt="">
            </div>
            <!--image 2-->
            <div class="form-outline mb-4 w-50 m-auto d-flex">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" value="<?php echo $disp_product_image2 ?>" autocomplete="off">
                <img class="edit_image" src="./product_images/<?php echo $disp_product_image2 ?>" alt="">
            </div>
            <!--image 3-->
            <div class="form-outline mb-4 w-50 m-auto d-flex">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" value="<?php echo $disp_product_image3 ?>" autocomplete="off">
                <img class="edit_image" src="./product_images/<?php echo $disp_product_image3 ?>" alt="">
            </div>
            <!--price-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" value="<?php echo $disp_product_price; ?>" autocomplete="off" required>
            </div>
            <!--submit-->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="update_product" class="btn btn-info mb-3 px-3" value="Update product">
            </div>
        </form>


    </div>
    <button class="my-1"><a href="./index.php" class="nav-link text-light bg-info my-1 px-2"><i class="fa-solid fa-rotate-left"></i></i>Go Back</a></button>

    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>