<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootsrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS link-->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 d-flex justify-content-center">
                <form action="" method="post" enctype="multipart/form-data">
                    <!--Username field-->
                    <div class="form-outline mb-4 ">
                        <label for="user_name" class="form-label">username</label>
                        <input type="text" id="user_name" class="form-control max-width-50" placeholder="Enter name" autocomplete="off" required="required" name="user_name" />

                    </div>
                    <!--Email field-->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">user Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter Email" autocomplete="off" required="required" name="user_email" />

                    </div>
                    <!--Image field-->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">username</label>
                        <input type="file" id="user_image" class="form-control" placeholder="Upload image" name="user_image" />

                    </div>
                    <!--Password field-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="enter password" name="user_password" />

                    </div>
                    <!--confirm password field-->
                    <div class="form-outline mb-4">
                        <label for="user_conf_password" class="form-label">Password</label>
                        <input type="password" id="user_conf_password" class="form-control" placeholder="Confirm your password" name="user_conf_password" />

                    </div>
                    <!--Address field-->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Aaddress</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter address" autocomplete="off" required="required" name="user_address" />

                    </div>

                    <!--phone number field-->
                    <div class="form-outline mb-4">
                        <label for="user_mobile" class="form-label">Mobile number</label>
                        <input type="text" id="user_mobile" class="form-control" placeholder="Enter address" autocomplete="off" required="required" name="user_mobile" />

                    </div>
                    <div class="d-flex">
                        <input type="submit" value="register" class="bg-info px-3 py-2 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already registered!</p><a class="small fw-bold mt-2 pt-1 mb-0" href="user_login.php">log in</a>
                    </div>
                </form>
            </div>
            <div>
                <a class="btn btn-primary" href="../index.php" role="button">Go home</a>
            </div>
        </div>
    </div>
    <?php
    include('../includes/footer.php');
    ?>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<?php
if (isset($_POST['user_register'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $user_conf_password = $_POST['user_conf_password'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $ip_add = get_ip_address();

    //checking if user already exists in database
    $select_query = "select * from `users` where user_name='$user_name' or user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0) {
        echo "<script>alert('Username or Emailalready exists!')</script>";
    } elseif ($user_password != $user_conf_password) {
        echo "<script>alert('Passwords did not match!')</script>";
    } else {

        //insert_query
        move_uploaded_file($user_image_tmp, "./users_images/$user_image");
        $insert_query = "insert into `users`(user_name,user_email,user_password,user_image,user_ip,user_address,user_mobile) values('$user_name','$user_email','$hash_password','$user_image','$ip_add','$user_address','$user_mobile')";
        $result_query = mysqli_query($con, $insert_query);
        if ($result_query) {
            echo "<script>alert('Registered successfully')</script>";
            echo "<script>window.open('user_login.php','_self')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
    //selecting cart items
    $select_cart_items = "select * from `cart_details` where ip_address='$ip_add'";
    $result_cart = mysqli_query($con, $select_cart_items);
    $row_count = mysqli_num_rows($result_cart);
    if ($row_count > 0) {
        $_SESSION['user_name'] = $user_name;
        echo "<script>alert('Your have items in cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')";
    }
}
?>