<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User login</title>
    <!-- bootsrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS link-->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-md-6 align-items-center justify-content-center mt-5">
                <form action="" method="post">

                    <!--username field-->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">user name</label>
                        <input type="text" id="user_name" class="form-control" placeholder="Enter name" autocomplete="off" required="required" name="user_name" />

                    </div>


                    <!--Password field-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="text" id="user_password" class="form-control" placeholder="enter password" name="user_password" />

                    </div>

            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" value="login" class="bg-info p-2 mx-3 border-0" name="user_login">
                <p class="small fw-bold mt-2 pt-1 mb-0">Not registered?</p><a href="user_reg.php" class="small fw-bold mt-2 pt-1 mb-0 ">Register</a>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php
global $con;
if (isset($_POST['user_login'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    //checking if user is registered in db
    $select_query = "select * from `users` where user_name='$user_name'";
    $result_user = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result_user);
    $row_data = mysqli_fetch_assoc($result_user);
    $ip_add = get_ip_address();

    //checking if there is item in cart
    $select_query_cart = "select * from `cart_details` where ip_address='$ip_add'";
    $result_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($result_cart);

    if ($row_count > 0) {
        $_SESSION['username'] = $user_name;
        if (password_verify($user_password, $row_data['user_password']) == true) {
            //echo "<script>alert('Login successful')</script>";
            if ($row_count > 0 and $row_count_cart < 1) {
                $_SESSION['username'] = $user_name;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                $_SESSION['username'] = $user_name;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid credentials')</script>";
            session_unset();
            session_destroy();
        }
    } else {
        echo "<script>alert('Invalid credentials')</script>";
        session_unset();
        session_destroy();
    }
}
?>