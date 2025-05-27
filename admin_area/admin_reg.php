<?php

include('../includes/connect.php'); // Include your DB connection file

if (isset($_POST['admin_register'])) {
    $username = trim(mysqli_real_escape_string($con, $_POST['username']));
    $email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if any field is empty
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('Please fill in all fields.')</script>";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.')</script>";
        exit();
    }

    // Check if username or email already exists
    $check_query = "SELECT * FROM `admins` WHERE admin_name='$username' OR admin_email='$email'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Username or email already exists.')</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $insert_query = "INSERT INTO `admins` (admin_name,admin_email,admin_password) VALUES ('$username', '$email', '$hashed_password')";
    $result = mysqli_query($con, $insert_query);

    if ($result) {
        echo "<script>alert('Admin registered successfully!')</script>";
        echo "<script>window.location.href='admin_login.php';</script>";
    } else {
        echo "<script>alert('Registration failed. Please try again.')</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--css file-->
    <link rel="stylesheet" href="../styles.css">
    <!-- font awesome link -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4 col-xl-4">
                <img src="../images/adminreg.jpg" alt="Admin registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <!-- Username -->
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username"
                            required class="form-control">
                    </div>
                    <!-- Email -->
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email"
                            required class="form-control">
                    </div>
                    <!-- Password -->
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            required class="form-control">
                    </div>
                    <!-- Confirm Password -->
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            placeholder="Confirm your password" required class="form-control">
                    </div>
                    <!-- Submit Button -->
                    <div class="form-outline mb-4 text-center">
                        <input type="submit" value="Register" name="admin_register"
                            class="btn btn-success px-4 py-2">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--include footer-->
    <?php include("../includes/footer.php"); ?>

    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
