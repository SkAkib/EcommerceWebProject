<?php
//include('../includes/connect.php');

//fetch images to display
if (isset($_GET['edit_category'])) {
    $category_id = $_GET['edit_category'];

    //fetch query
    $fetch_data = "select * from `categories` where category_id=$category_id";
    $result_fetch = mysqli_query($con, $fetch_data);
    $row_result_fetch = mysqli_fetch_assoc($result_fetch);
    $disp_category_id = $row_result_fetch['category_id'];
    $disp_category_title = $row_result_fetch['category_title'];
}

//////////////////////////////////////////////////////////////////

if (isset($_POST['update_category'])) {
    $category_title = $_POST['category_title'];

    // Update query
    $update_category = "UPDATE `categories` SET 
        category_title='$category_title'
        WHERE category_id=$category_id";

    $result_query = mysqli_query($con, $update_category);

    if ($result_query) {
        echo "<script>alert('Product updated successfully')</script>";
        echo "<script>window.open('index.php?edit_category=$category_id','_self')</script>";
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

<body class="bg-light">
           <div class="container">
        <h1 class="text-center mt-3">Edit Category</h1>
        <!--form-->
        <form action="" method="post">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="category_title" class="form-label">Category title</label>
                <input type="text" name="category_title" id="category_title" class="form-control" value="<?php echo $disp_category_title; ?>" autocomplete="off" required="required">
            </div>


            <!--submit-->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="update_category" class="btn btn-info mb-3 px-3" value="Update category">
            </div>
        </form>


    </div>
    <button class="my-1"><a href="./index.php" class="nav-link text-light bg-info my-1 px-2"><i class="fa-solid fa-rotate-left"></i></i>Go Back</a></button>

    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>