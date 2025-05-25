<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--css file-->
    <link rel="stylesheet" href="../styles.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <h3 class="text-center">Admin Login</h3>
   <div class="container-fluid">
    <div class="row">
        <div class="col-md-6 bg-dark">Image</div>
        <div class="col-md-6 col-sm-10 bg-danger">
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
                    <div class="d-flex justify-content-center">
                        <input type="submit" value="login" class="bg-info p-2 mx-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Not registered?</p><a href="user_reg.php" class="small fw-bold mt-2 pt-1 mb-0 ">Register</a>
                    </div>
            </form>

        </div>
    </div>
   </div> 

   <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>