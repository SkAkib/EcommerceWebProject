<?php
session_start();
include('../includes/connect.php'); // DB connection

if (isset($_POST['user_login'])) {
    $username = trim(mysqli_real_escape_string($con, $_POST['user_name']));
    $password = $_POST['user_password'];

    // Fetch user record
    $query = "SELECT * FROM `admins` WHERE admin_name='$username'";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_hash = $row['admin_password'];

        if (password_verify($password, $stored_hash)) {
            $_SESSION['admin_name'] = $username;
            echo "<script>alert('Login successful!')</script>";
            echo "<script>window.location.href='index.php';</script>"; // Redirect to admin dashboard
        } else {
            echo "<script>alert('Invalid password!')</script>";
        }
    } else {
        echo "<script>alert('Admin not found!')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>
    <div class="container-fluid">
        <h3 class="text-center text-primary mt-5">Admin Login</h3>
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <form action="admin_login.php" method="post" class="p-4 border rounded shadow bg-light">
                    <!-- Username -->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter username" required autocomplete="off">
                    </div>
                    <!-- Password -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" name="user_password" class="form-control" placeholder="Enter password" required>
                    </div>
                    <!-- Login Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" name="user_login" class="btn btn-info text-white">Login</button>
                    </div>
                    <!-- Register Redirect -->
                    <p class="small mt-3 text-center">
                        Not registered? <a href="admin_reg.php" class="text-decoration-none">Register here</a>
                    </p>
                </form>
            </div>
            <a href="../index.php" class="bg-dark text-white text-center mt-3"><i class="fa-solid fa-house"></i> Go Home</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
